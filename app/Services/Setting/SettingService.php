<?php

namespace App\Services\Setting;

use App\Models\Setting;

class SettingService
{
    /**
     * @var Setting
     */
    private $settingModel;

    /**
     * SettingService constructor.
     * @param Setting $settingModel
     */
    public function __construct(Setting $settingModel)
    {
        $this->settingModel = $settingModel;
    }

    /**
     * @param $field
     * @return mixed
     */
    public function getField($field)
    {
        return $this->settingModel->where('field', $field)->first();
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->settingModel->get();
    }

    /**
     * @param $field
     * @param $value
     * @return mixed
     */
    public function attach($field,$value)
    {
        $entry = $this->settingModel->firstOrCreate(['field'=>$field]);
        return $entry->update(['value'=>$value]);
    }

    public function delete($field)
    {
        return $this->settingModel->where('field', $field)->delete();
    }

}