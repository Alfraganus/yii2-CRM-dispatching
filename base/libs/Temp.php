<?php

namespace base\libs;

/**
 * Temp class
 */
class Temp
{
    private $active;
    /**
     * Contstructor
     */


    /**
     * Get array from file
     *
     * @param string $folder
     * @param string $filename
     * @return array
     */
    public function getArray($folder, $filename)
    {
        $array = array();

        if ($this->active) {
            $path = $this->dir($folder);
            $filename = str_replace('.php', '', $filename);
            $file = $path . $filename . '.php';

            if (is_file($file)) {
                $array = include $file;
            }
        }

        return $array;
    }

    /**
     * Create temp for type
     *
     * @param string $type
     * @return void
     */
    public function createFor($type)
    {
        if (!$this->active) {
            return;
        }

        if ($type == 'countries') {
            $this->setCountries();
        } elseif ($type == 'currency') {
            $this->setCurrency();
        } elseif ($type == 'languages') {
            $this->setLanguages();
        } elseif ($type == 'regions') {
            $this->setRegions();
        } elseif ($type == 'settings') {
            $this->setSettings();
        }
    }

    /**
     * Set languages
     *
     * @return void
     */


    /**
     * Set settings
     *
     * @return void
     */

    /**
     * Set currency
     *
     * @return void
     */
    public function setCurrency()
    {
        if (!$this->active) {
            return;
        }

        $path = $this->dir('system');
        $list = $path . 'currency_list.php';
        $rates = $path . 'currency_rates.php';

        $list_results = \common\models\CurrencyList::find()
            ->where(['status' => 1])
            ->orderBy(['sort' => SORT_ASC, 'currency_name' => SORT_ASC])
            ->asArray()
            ->all();

        $rate_results = \common\models\CurrencyRates::find()
            ->asArray()
            ->all();

        if ($list_results) {
            $this->writeArray($list, $list_results);
        }

        if ($rate_results) {
            $this->writeArray($rates, $rate_results);
        }
    }

    /**
     * Set countries
     *
     * @return void
     */
    public function setCountries()
    {
        if (!$this->active) {
            return;
        }

        $path = $this->dir('system');
        $file = $path . 'countries.php';

        $results = \common\models\Countries::find()
            ->orderBy(['name' => SORT_ASC])
            ->asArray()
            ->all();

        if ($results) {
            $this->writeArray($file, $results);
        }
    }

    /**
     * Set regions
     *
     * @return void
     */
    public function setRegions()
    {
        if (!$this->active) {
            return;
        }

        $path = $this->dir('system');
        $file = $path . 'regions.php';

        $results = \common\models\Regions::find()
            ->orderBy(['sort' => SORT_ASC, 'name' => SORT_ASC])
            ->asArray()
            ->all();

        if ($results) {
            $this->writeArray($file, $results);
        }
    }

    /**
     * Dir for temp
     *
     * @param string $name
     * @return void
     */
    public function dir($name)
    {
        $path_name = str_replace('/', DS, $name);
        $path_name = trim($path_name, DS);
        $path = TEMP_PATH . $path_name . DS;

        if (!is_dir($path)) {
            mkdir($path);
        }

        return $path;
    }

    /**
     * Write array to file
     *
     * @param string $file
     * @param array $array
     * @return void
     */
    public function writeArray($file, $array)
    {
        $write = "";

        if (is_array($array) && $array) {
            $write = "<?php\nreturn " . var_export($array, true) . "\n?>";
        }

        file_put_contents($file, $write);
    }
}
