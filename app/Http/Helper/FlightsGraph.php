<?php

namespace App\Http\Helper;

class FlightsGraph
{
    private $nodes = [];
    private $visited = [];
    private $routes = [];
    private $max;

    public function __construct($routes, $max = 20)
    {
        $this->nodes = [];
        $this->max = $max;

        if ($routes) {
            foreach ($routes as $val) {
                $this->visited[$val['source_airport_id']] = $this->visited[$val['destination_airport_id']] = false;
                $this->add($val['source_airport_id'], $val['destination_airport_id'], $val['price']);
            }
        }
    }

    public function add($a, $b, $distance, bool $addInverseEdge = true): FlightsGraph
    {
        if (!is_numeric($distance)) {
            return false;
        }
        $distance = floatval($distance);
        $this->nodes[$a][$b] = $distance;

        if ($addInverseEdge) {
            $this->nodes[$b][$a] = $distance;
        }
        return $this;
    }

    public function getNodes(): array
    {
        return $this->nodes;
    }

    public function search($from, $to): array
    {
        if (!isset($this->nodes[$from]) || !isset($this->nodes[$to])) {
            throw new \UnexpectedValueException("node {$from} or node {$to} does not exist");
        }
        $path = $routes = [];

        $this->getAllRoutes($from, $to, $path, $routes);

        return $this->routes;
    }

    private function getAllRoutes($from, $to, $path)
    {
        $this->visited[$from] = true;
        $path[] = $from;

        if ($from == $to) {
            $this->routes[] = $path;
            if (count($this->routes) == $this->max) {
                return false;
            }
        } else {
            if (!isset($this->nodes[$from])) {
                throw new \UnexpectedValueException("Next node {$from} does not exist");
            }
            foreach ($this->nodes[$from] as $key => $val) {
                if ($this->visited[$key] == false) {
                    $this->getAllRoutes($key, $to, $path);
                }
            }
        }

        $this->visited[$from] = false;
    }

    public function prices($routes)
    {
        if ($routes) {
            foreach ($routes as $key => $path) {
                $length = count($path) - 1;
                $prices[$key] = 0;
                for ($i = 0; $i < $length; $i++) {
                    $j = $i + 1;
                    $prices[$key] += $this->nodes[$path[$i]][$path[$j]];
                }
            }

            return $prices;
        }

        return false;
    }
}
