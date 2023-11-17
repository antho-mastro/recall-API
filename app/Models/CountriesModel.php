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
}
