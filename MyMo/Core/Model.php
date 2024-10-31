<?php

namespace MyMo\Core;

class Model {
	protected $table = null;
	protected $fillable = [];
	protected $primaryKey = 'id';
	protected $prefix = MYMO_PREFIX;
	protected $attributes = [];
	protected $timestamps = true;
	protected $changeby = true;
	
	public function __get($key) {
		return $this->get_attribute($key);
	}
	
	public function __set($key, $value) {
		$this->set_attribute($key, $value);
	}
	
	public function __unset($key) {
		unset($this->attributes[$key]);
	}
	
	public function fill(array $attributes) {
		foreach ($attributes as $key => $item) {
			if (in_array($key, $this->fillable)) {
				$this->{$key} = $item;
			}
		}
	}
	
	public function save() {
		global $wpdb;
		
		if (empty($this->get_attribute($this->primaryKey))) {
			if ($this->timestamps) {
				$this->created_at = date('Y-m-d H:i:s');
				$this->updated_at = date('Y-m-d H:i:s');
			}
			
			if ($this->changeby) {
				$this->created_by = get_current_user_id();
				$this->updated_by = get_current_user_id();
			}
			
			$insert = $wpdb->insert($wpdb->prefix . $this->prefix . $this->table, $this->attributes);
			$this->set_attribute($this->primaryKey, $wpdb->insert_id);
			return $insert;
		}
		
		$attributes = $this->attributes;
		unset($attributes[$this->primaryKey]);
		
		if ($this->timestamps) {
			$this->updated_at = date('Y-m-d H:i:s');
		}
		
		if ($this->changeby) {
			$this->updated_by = get_current_user_id();
		}
		
		$wpdb->update($wpdb->prefix . $this->prefix . $this->table, $attributes, [
			$this->primaryKey => $this->{$this->primaryKey},
		]);
		
		return $this->get_attribute($this->primaryKey);
	}
	
	public function insert(array $attributes) {
		$this->attributes = [];
		foreach ($attributes as $key => $attribute) {
			$this->set_attribute($key, $attribute);
		}
		
		$this->save();
	}
	
	public function update(array $attributes) {
		foreach ($attributes as $key => $attribute) {
			$this->set_attribute($key, $attribute);
		}
		
		$this->save();
	}
	
	public function set_attribute($key, $value) {
		$this->attributes[$key] = $value;
	}
	
	public function get_attribute($key) {
		if (isset($this->attributes[$key])) {
			return $this->attributes[$key];
		}
		
		return null;
	}
	
	public static function find($primaryKey, array $columns = ['*']) {
		global $wpdb;
		$columns = implode(',', $columns);
		$model = (new static);
		$sql = "SELECT $columns FROM {$wpdb->prefix}{$model->prefix}{$model->table} WHERE {$model->primaryKey} = %d";
		$attributes = $wpdb->get_row($wpdb->prepare($sql, [$primaryKey]), ARRAY_A);
		if ($attributes) {
			$model->attributes = $attributes;
			return $model;
		}
		
		return false;
	}
	
	public static function first_or_new(array $attributes) {
		global $wpdb;
		$model = (new static);
		$sql = "SELECT * FROM {$wpdb->prefix}{$model->prefix}{$model->table}";
		
		$where = [];
		$params = [];
		foreach ($attributes as $key => $item) {
			$where[] = "{$key} = " . (is_numeric($item) ? "%d" : "%s");
			$params[] = $item;
		}
		
		$model = (new static);
		$sql .= " WHERE " . implode(' AND ', $where);
		$attributes = $wpdb->get_row($wpdb->prepare($sql, $params), ARRAY_A);
		if ($attributes) {
			$model->attributes = $attributes;
		}
		
		return $model;
	}
	
	public static function get_row(array $conditions, $fields='*', $orderby = '') {
		global $wpdb;
		$model = (new static);
		$sql = "SELECT {$fields} FROM {$wpdb->prefix}{$model->prefix}{$model->table}";
		if (empty($conditions)) {
			if ($orderby) {
				$sql .= " ORDER BY " . $orderby;
			}
			
			return $wpdb->get_row($sql);
		}
		
		$where = [];
		$params = [];
		foreach ($conditions as $key => $item) {
			$where[] = "`{$key}` = " . (is_numeric($item) ? "%d" : "%s");
			$params[] = $item;
		}
		$sql .= " WHERE " . implode(' AND ', $where);
		
		if ($orderby) {
			$sql .= " ORDER BY " . $orderby;
		}
		
		return $wpdb->get_row($wpdb->prepare($sql, $params));
	}
	
	public static function get_rows(array $conditions, $fields='*', $orderby = '', $limit = '') {
		global $wpdb;
		$model = (new static);
		$sql = "SELECT {$fields} FROM {$wpdb->prefix}{$model->prefix}{$model->table}";
		if (empty($conditions)) {
			if ($orderby) {
				$sql .= " ORDER BY " . $orderby;
			}
			
			if ($limit) {
				$sql .= " LIMIT " . $limit;
			}
			
			return $wpdb->get_results($sql);
		}
		
		$where = [];
		$params = [];
		foreach ($conditions as $key => $item) {
			$where[] = "`{$key}` = " . (is_numeric($item) ? "%d" : "%s");
			$params[] = $item;
		}
		$sql .= " WHERE " . implode(' AND ', $where);
		
		if ($orderby) {
			$sql .= " ORDER BY " . $orderby;
		}
		
		if ($limit) {
			$sql .= " LIMIT " . $limit;
		}
		
		return $wpdb->get_results($wpdb->prepare($sql, $params));
	}
	
	public static function get_var(array $conditions, $field='id') {
		global $wpdb;
		$model = (new static);
		$sql = "SELECT {$field} FROM {$wpdb->prefix}{$model->prefix}{$model->table}";
		if (empty($conditions)) {
			return $wpdb->get_var($sql);
		}
		
		$where = [];
		$params = [];
		foreach ($conditions as $key => $item) {
			$where[] = "`{$key}` = " . (is_numeric($item) ? "%d" : "%s");
			$params[] = $item;
		}
		$sql .= " WHERE " . implode(' AND ', $where);
		return $wpdb->get_var($wpdb->prepare($sql, $params));
	}
}