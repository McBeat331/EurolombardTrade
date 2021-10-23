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
        if($this->getField($field))
        {
            $entry = $this->getField($field);
            $entry->update(['value'=>$value]);
        }
        else
        {
            $entry = $this->settingModel;
            $entry->field = $field;
            $entry->value = $value;
            $entry->save();
        }
    }

    public function delete($field)
    {
        return $this->settingModel->where('field', $field)->delete();
    }

}