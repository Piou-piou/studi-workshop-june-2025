<?php

namespace App\Search;

use App\Database\Db;
use DateTime;
use PDO;
use PDOStatement;

class DataSearch
{
    private array $filters = [];

    public function __construct(private string $queryString)
    {
        $this->defineFilters();
    }

    public function search(): array
    {
        $this->completeQueryString();

        $query = Db::pdo()->prepare($this->queryString);

        $this->bindValuesToQuery($query);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    private function completeQueryString(): void
    {
        $hasWhere = false;
        $filterNumber = count($this->filters);
        $iteration = 1;

        foreach ($this->filters as $key => $value) {
            if (false === $hasWhere) {
                $this->queryString .= ' WHERE ';
                $hasWhere = true;
            }

            $filterType = $this->getFilterTypeOrPercentage($value);

            $key = $this->getFormattedKey($key);
            $this->queryString .= $key . ' ' . $filterType . ' :' . $key;

            if ($iteration < $filterNumber) {
                $this->queryString .= ' AND ';
            }

            $iteration++;
        }
    }

    private function bindValuesToQuery(PDOStatement $query): void
    {
        foreach ($this->filters as $key => $value) {
            $percentage = $this->getFilterTypeOrPercentage($value, false);

            // ici vraiment valider le format de la date avant de la créer pour éviter une faux positif
            if (str_contains($value, '/')) {
                $value = DateTime::createFromFormat('d/m/Y', $value);
                $value = $value->format('Y-m-d');
            }

            $query->bindValue(':' . $this->getFormattedKey($key), $percentage . $value . $percentage);
        }
    }

    private function defineFilters(): void
    {
        if (!$_GET) {
            return;
        }

        $this->filters = array_filter($_GET, function ($key) {
            return str_starts_with($key, 'filter_');
        }, ARRAY_FILTER_USE_KEY);
    }

    private function getFormattedKey(string $key): string
    {
        return str_replace('filter_', '', $key);
    }

    private function getFilterTypeOrPercentage(mixed $value, bool $filterType = true): ?string
    {
        $symbol = $filterType ? 'LIKE' : '%';
        if (is_numeric($value)) {
            $symbol = $filterType ? '=' : null;
        }

        return $symbol;
    }
}