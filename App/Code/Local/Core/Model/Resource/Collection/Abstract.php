<?php

class Core_Model_Resource_Collection_Abstract
{
    protected $_resource;
    protected $_model;
    protected $_select;

    public function setResource($resource)
    {
        $this->_resource = $resource;
        return $this;
    }
    public function setModel($model)
    {
        $this->_model = $model;
        return $this;
    }

    public function select()
    {
        $this->_select["FROM"] = $this->_resource->gettableName();
        $this->_select["COLUMNS"] = [];
    }
    public function getData()
    {
        $data = $this->_resource->getAdapter()->fetchAll($this->prepareQuery());
        foreach ($data as &$_data) {
            $_model = new $this->_model;
            $_data = $_model->setData($_data);
        }
        return $data;
    }
    public function addFieldToFilter($field, $condition)
    {
        if (!is_array($condition)) {
            $condition = ['eq' => $condition];
        }
        $this->_select['WHERE'][$field][] = $condition;
        return $this;
    }
    public function preparequery()
    { {

            if ($this->_select["COLUMNS"] == []) {
                $col = "*";
            } else {
                $col = implode(",", $this->_select["COLUMNS"]);
            }
            $query = sprintf("SELECT %s FROM %s", $col, $this->_select["FROM"]);

            if (isset($this->_select['JOIN_LEFT'])) {
                $joinsql = "";

                foreach ($this->_select["JOIN_LEFT"] as $joinleft) {
                    $joinsql = sprintf(" LEFT JOIN %s on %s", $joinleft['tablename'], $joinleft['condition']);
                }
                $query = $query . " " . $joinsql;
            }
            if (isset($this->_select['JOIN_RIGHT'])) {
                $joinsql = "";
                foreach ($this->_select["JOIN_RIGHT"] as $joinright) {
                    $joinsql = sprintf(" RIGHT JOIN %s on %s", $joinright['tablename'], $joinright['condition']);
                }
                $query = $query . " " . $joinsql;
            }
            if (isset($this->_select['JOIN_FULL'])) {
                $joinsql = "";
                foreach ($this->_select["JOIN_FULL"] as $joinfull) {
                    // $joinsql = sprintf(" FULL JOIN %s on %s", $joinfull['tablename'], $joinfull['condition']);
                    $joinsql = sprintf(" FULL JOIN %s ", $joinfull['tablename']);
                }
                $query = $query . " " . $joinsql;
                // die;
            }
            if (isset($this->_select['CROSS_JOIN'])) {
                $joinsql = "";
                foreach ($this->_select["CROSS_JOIN"] as $joincross) {
                    // $joinsql = sprintf(" FULL JOIN %s on %s", $joinfull['tablename'], $joinfull['condition']);
                    $joinsql = sprintf(" CROSS JOIN %s ", $joincross['tablename']);
                }
                $query = $query . " " . $joinsql;
            }
            if (isset($this->_select['INNER_JOIN'])) {
                $joinsql = "";
                foreach ($this->_select["INNER_JOIN"] as $joininner) {
                    $joinsql = sprintf(" INNER JOIN %s ON %s ", $joininner['tablename'], $joininner['condition']);
                }
                $query = $query . " " . $joinsql;
            }
            if (isset($this->_select['SELF_JOIN'])) {
                $joinsql = "";
                foreach ($this->_select["SELF_JOIN"] as $joinself) {
                    // $joinsql = sprintf(" FULL JOIN %s on %s", $joinfull['tablename'], $joinfull['condition']);
                    $joinsql = sprintf("%s,%s %s ", $joinself['tablealeas'][0], $this->_select["FROM"], $joinself['tablealeas'][1]);
                }
                $query = $query . " " . $joinsql;

                // die;
            }
            if (isset($this->_select['GROUP_BY'])) {
                $groupby = "";
                // foreach ($this->_select["GROUP_BY"] as $having) {
                // $joinsql = sprintf(" FULL JOIN %s on %s", $joinfull['tablename'], $joinfull['condition']);
                $groupby = sprintf("GROUP BY %s", implode(",", $this->_select["GROUP_BY"]['columns']));
                // }
                $query = $query . " " . $groupby;
                // print_r($query);
                // die;
            }
            if (isset($this->_select['HAVING'])) {
                $having = "";
                $condition = [];
                foreach ($this->_select['HAVING'] as $field => $value) {
                    foreach ($value as $_value) {
                        $condition[]  = $this->Where($field, $_value);
                    }
                }
                $having = sprintf("HAVING %s", implode(",",  $condition));

                $query = $query . " " . $having;
            }
            if (isset($this->_select['ORDER_BY'])) {
                $orderBy = "";
                // foreach ($this->_select["GROUP_BY"] as $having) {
                // $joinsql = sprintf(" FULL JOIN %s on %s", $joinfull['tablename'], $joinfull['condition']);
                $orderBy = sprintf("ORDER BY %s", implode(",", $this->_select["ORDER_BY"]['columns']));

                // }
                $query = $query . " " . $orderBy;
            }
            if (isset($this->_select['LIMIT'])) {
                $orderBy = "";
                // foreach ($this->_select["GROUP_BY"] as $having) {
                // $joinsql = sprintf(" FULL JOIN %s on %s", $joinfull['tablename'], $joinfull['condition']);
                $orderBy = sprintf("LIMIT %s", $this->_select["LIMIT"]["limit"]);

                // }
                $query = $query . " " . $orderBy;
            }
        }
        if (isset($this->_select['WHERE'])) {
            $wheresql = '';

            $count = count($this->_select['WHERE']);
            $condition = [];
            foreach ($this->_select['WHERE'] as $field => $value) {
                foreach ($value as $_value) {
                    $condition[]  = $this->Where($field, $_value);
                }
            }
            $wheresql .= " WHERE" . implode("AND", $condition);
            $query = $query . $wheresql;
        }
        return $query;
    }

    public function Where($column, $val)
    {

        if (is_array($val)) {
            foreach ($val as $operator => $value) {
                switch (strtoupper($operator)) {
                    case 'IN':
                    case 'NOT IN':
                        if (!is_array($value)) {
                            throw new Exception("Wrong input.");
                        }
                        $where = " {$column} {$operator} ('" . implode("','", $value) . "') ";
                        break;

                    case 'NOT BETWEEN':
                    case 'BETWEEN':
                        if (!is_array($value) || count($value) !== 2) {
                            throw new Exception("Wrong input.");
                        }
                        $where = " {$column} {$operator} '{$value[0]}' AND '{$value[1]}' ";
                        break;

                    case 'LIKE':
                    case 'NOT LIKE':
                        $where = " {$column} {$operator} '{$value}' ";
                        break;
                    case 'EQ':
                        $where = " {$column} = '{$value}' ";
                        break;
                    default:
                        $where = " {$column} {$operator} '{$value}' ";
                        break;
                }
            }
        }
        return $where;
    }
    public function joinLeft($tablename, $condition, $columns)
    {
        $this->_select["JOIN_LEFT"][] = ["tablename" => $tablename, "condition" => $condition, "columns" => $columns];
        foreach ($columns as $alies => $columnName) {
            $this->_select["COLUMNS"][] = sprintf("%s.%s as %s", $tablename, $columnName, $alies);
        }
        return $this;
    }
    public function joinRight($tablename, $condition, $columns)
    {
        $this->_select["JOIN_RIGHT"][] = ["tablename" => $tablename, "condition" => $condition, "columns" => $columns];
        foreach ($columns as $alies => $columnName) {
            $this->_select["COLUMNS"][] = sprintf("%s.%s as %s", $tablename, $columnName, $alies);
        }
        return $this;
    }
    public function joinFull($tablename, $columns)
    {
        $this->_select["JOIN_FULL"][] = ["tablename" => $tablename,  "columns" => $columns];
        foreach ($columns as $alies => $columnName) {
            $this->_select["COLUMNS"][] = sprintf("%s.%s as %s", $tablename, $columnName, $alies);
        }
        return $this;
    }
    public function joinCross($tablename, $columns)
    {
        $this->_select["CROSS_JOIN"][] = ["tablename" => $tablename, "columns" => $columns];
        foreach ($columns as  $columns => $alias) {
            $this->_select["COLUMNS"][] = sprintf("%s.%s AS %s ",  $tablename, $alias, $columns);
        }
        return $this;
    }
    public function joinInner($tablename, $condition, $columns)
    {
        $this->_select["INNER_JOIN"][] = ["tablename" => $tablename, "condition" => $condition, "columns" => $columns];
        foreach ($columns as $alies => $columnName) {
            // echo "1223";
            $this->_select["COLUMNS"][] = sprintf("%s.%s as %s", $tablename, $columnName, $alies);
        }
        return $this;
    }
    public function joinSelf($tablealeas, $columns)
    {
        $this->_select["SELF_JOIN"][] = ["tablealeas" => $tablealeas,  "columns" => $columns];
        foreach ($columns as $alies => $columnName) {
            $this->_select["COLUMNS"][] = sprintf("%s as %s",  $columnName, $alies);
        }

        return $this;
    }
    public function groupBy($columns)
    {
        $this->_select["GROUP_BY"] = ["columns" => $columns];
        // print_r($this);
        foreach ($columns as  $columnName) {
            $this->_select["COLUMNS"][] = sprintf("%s", $columnName);
            // print_r($this);
        }
        // print_r($this);
        return $this;
    }
    public function having($columns, $condition)
    {
        // $this->_select["HAVING"] = ["columns" => $columns, "condition" => $condition];
        if (!is_array($condition)) {
            $condition = ['eq' => $condition];
        }
        $this->_select['HAVING'][$columns] = ["condition" => $condition];

        // print_r($this);
        // foreach ($columns as  $columnName) {
        //     $this->_select["COLUMNS"] = sprintf("%s ", $columnName, $condition);
        // }
        // print_r($this);
        return $this;
    }
    public function orderBy($columns)
    {
        $this->_select["ORDER_BY"] = ["columns" => $columns];
        return $this;
    }
    public function limit($limit, $offset = '')
    {
        $this->_select["LIMIT"] = ["limit" => $limit, "offset" => $offset];

        return $this;
    }
}
