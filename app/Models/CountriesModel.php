<?php

namespace Vanier\Api\Models;

use Vanier\Api\Models\BaseModel;

class CountriesModel extends BaseModel
{
    private string $table_name = 'countries';
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllCountries(){
        $sql = "SELECT * FROM countries";
        return $this->paginate($sql);
    }

    public function getCountryById(int $country_id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE CountryID = :CountryID";
        return $this->run($sql, [":CountryID" => $country_id])->fetchAll();
    }

    public function countryCreate(array $new_countries)
    {
        return $this->insert($this->table_name, $new_countries);
    }

    public function deleteCountry($country_id)
    {
        $this->delete($this->table_name, ["CountryID" => $country_id]);
    }


    public function CountryUpdate(array $country_data, array $country_id)
    {
        $this->update($this->table_name, $country_data, $country_id);
    }

    /*public function getAll(array $filters = [])
    {
        $query_value = [];
        $sql = "SELECT film.*, language.name FROM film  JOIN language ON film.language_id = language.language_id WHERE 1";

        if (isset($filters["description"])) {
            $sql .= " AND film.description LIKE CONCAT('%', :description,'%')";
            $query_value[":description"] = $filters["description"];
        }
        if (isset($filters["title"])) {
            $sql .= " AND film.title LIKE CONCAT('%', :title,'%')";
            $query_value[":title"] = $filters["title"];
        }
        if (isset($filters["special_features"])) {
            $sql .= " AND film.special_features LIKE CONCAT('%', :special_features,'%')";
            $query_value[":special_features"] = $filters["special_features"];
        }
        if (isset($filters["rating"])) {
            $sql .= " AND film.rating LIKE CONCAT('%', :rating,'%')";
            $query_value[":rating"] = $filters["rating"];
        }
        if (isset($filters["language"])) {
            $sql .= " AND language.name LIKE CONCAT('%', :language,'%')";
            $query_value[":language"] = $filters["language"];
        }
        return $this->paginate($sql, $query_value);
    }*/

    /*public function getFilmsByCategory(int $category_id)
    {
        
        $sql = "SELECT category.*, actor.first_name, actor.last_name, film.* FROM category JOIN film_category ON category.category_id = film_category.category_id JOIN film ON film.film_id = film_category.film_id JOIN film_actor ON film_actor.film_id = film.film_id JOIN actor on actor.actor_id = film_actor.actor_id WHERE category.category_id = :category_id;";
        return $this->run($sql, [":category_id" => $category_id])->fetchAll();
    }*/
}
