<?php

class Json
{
    private $jsonFile = "json_files/books.json";

    public function getRows()
    {
        if (file_exists($this->jsonFile)) {
            $jsonData = file_get_contents($this->jsonFile);
            $data = json_decode($jsonData, true);

            if (!empty($data)) {
                usort($data, function ($a, $b) {
                    return $b['isbn'] - $a['isbn'];
                });
            }
            return !empty($data) ? $data : false;
        }
        return false;
    }
    public function getSingle($id)
    {
        $jsonData = file_get_contents($this->jsonFile);
        $data = json_decode($jsonData, true);
        $singleData = array_filter($data, function ($var) use ($id) {
            return (!empty($var['isbn']) && $var['isbn'] == $id);
        });
        $singleData = array_values($singleData)[0];
        return !empty($singleData) ? $singleData : false;
    }
    public function insert($newData)
    {
        if (!empty($newData)) {
            $id = time();
            $newData['isbn'] = $id;

            $jsonData = file_get_contents($this->jsonFile);
            $data = json_decode($jsonData, true);

            $data = !empty($data) ? array_filter($data) : $data;

            if (!empty($data)) {
                array_push($data, $newData);
            } else {
                $data[] = $newData;
            }
            $insert = file_put_contents($this->jsonFile, json_encode($data));

            return $insert ? $id : false;
        } else {
            return false;
        }
    }

    public function update($upatedData, $id): bool
    {


        if (!empty($upatedData) && is_array($upatedData) && !empty($id)) {

            $jsonData = file_get_contents($this->jsonFile);
            $data = json_decode($jsonData, true);

            foreach ($data as $key => $value) {
                if ($value['isbn'] == $id) {
                    if (isset($upatedData['title'])) {
                        $data[$key]['title'] = $upatedData['title'];
                    }
                    if (isset($upatedData['author'])) {
                        $data[$key]['author'] = $upatedData['author'];
                    }
                    if (isset($upatedData['available'])) {
                        $data[$key]['available'] = $upatedData['available'];
                    }
                    if (isset($upatedData['pages'])) {
                        $data[$key]['pages'] = $upatedData['pages'];
                    }
                }
            }
            $update = file_put_contents($this->jsonFile, json_encode($data));
            return $update ? true : false;
        } else {
            return false;
        }
    }
    public function getCopy($id): bool
    {
        # if not id  return
        if (empty($id)) return false;


        $jsonData = file_get_contents($this->jsonFile);
        $data = json_decode($jsonData, true);
        $update = false;

        foreach ($data as $key => $value) {
            if ($value['isbn'] == $id) {

                if ($value['available'] > 0) {
                    $data[$key]['available']--;
                    $bookData = array(
                        'available' => $data[$key]['available']--
                    );
                    $update = $this->update($bookData, $id);
                }
                break;
            }
        }

        return $update;
    }

    
    public function addCopy($id): bool
    {
        # if not id  return
        if (empty($id)) return false;


        $jsonData = file_get_contents($this->jsonFile);
        $data = json_decode($jsonData, true);
        $update = false;

        foreach ($data as $key => $value) {
            if ($value['isbn'] == $id) {

               
                $data[$key]['available']++;
                $update = file_put_contents($this->jsonFile, json_encode($data));
                
                break;
            }
        }

        return $update ? true : false;
    }
    function delete($id)
    {
        $jsonData = file_get_contents($this->jsonFile);
        $data = json_decode($jsonData, true);

        $newData = array_filter($data, function ($var) use ($id) {
            return ($var['isbn'] != $id);
        });

        $delete = file_put_contents($this->jsonFile, json_encode($newData));

        return $delete ? true : false;
    }
}
