<?php

	class Page extends Model
	{

//	    public  function getStockProduct()
//        {
//            $sql = "SELECT product_type, img, features, price FROM product WHERE stock = 1";
//            return $this->db->query($sql);
//        }

        public  function getStockProductByType($type)
        {
            $sql = "SELECT id, product_type, img, features, price FROM product WHERE stock = 1 AND product_type = '$type' LIMIT 2";
            return $this->db->query($sql);
        }


        public  function getThreeProduct($type)
        {
            $sql = "SELECT id, img, features, price FROM product WHERE product_type = '{$type}' AND stock = 0 LIMIT 3";
            return $this->db->query($sql);
        }

        public function getCategory($type)
        {
            $sql = "SELECT * FROM product WHERE product_type = '{$type}'";
            return $this->db->query($sql);
        }

        public function getById($id)
        {
            $id = (int) $id;

            $sql    = "select * from product where id = {$id} limit 1";
            $result = $this->db->query($sql);

            return isset($result[0]) ? $result[0] : null;

        }




    public function saveUser($data, $id = null)
    {
        if (!isset($data['name']) || !isset($data['email']) || !isset($data['password']) || !isset($data['confirm_password']))
        {
            return false;
        }

        $id      = (int) $id;
        $name    = $this->db->escape($data['name']);
        $email   = $this->db->escape($data['email']);
        $password = $this->db->escape($data['password']);

        if (!$id)
        {
            $sql = "insert into user
								set user_name = '{$name}',
									user_email = '{$email}',
									user_password = '{$password}'
							";
        }
        else
        {
//            $sql = "update messages
//								set name = '{$name}',
//										email = '{$email}',
//										message = '{$message}'
//								where id = {$id}
//							";
        }

        return $this->db->query($sql);
    }




    public function saveMessage($data, $id = null)
    {
        if (!isset($data['name']) || !isset($data['email']) || !isset($data['message']))
        {
            return false;
        }

        $id      = (int) $id;
        $name    = $this->db->escape($data['name']);
        $email   = $this->db->escape($data['email']);
        $message = $this->db->escape($data['message']);

        if ($id)
        {
            $sql = "insert into messages 
								set name = '{$name}',
										email = '{$email}',
										message = '{$message}',
										product_id = '{$id}'
							";
        }
//            else
//            {
//                $sql = "update messages
//								set name = '{$name}',
//										email = '{$email}',
//										message = '{$message}'
//								where id = {$id}
//							";
//            }

        return $this->db->query($sql);
    }



    // получаем комментарии под товаром
    public function getMessagesById($id)
    {
        $id = (int) $id;

        $sql    = "SELECT name, message, date_comment FROM messages WHERE product_id = '{$id}' ORDER BY date_comment DESC";
        return  $this->db->query($sql);

        //return isset($result[0]) ? $result[0] : null;
    }




		public function getList($stock = false)
		{
			$sql = "SELECT * FROM product WHERE 1";

			if ($stock)
			{
				$sql .= ' AND stock = 1';
			}

			return $this->db->query($sql);
		}

		public function getByProductType($alias)
		{
			$alias = $this->db->escape($alias);

			$sql    = "select * from pages where product_type = '{$alias}' limit 1";
			$result = $this->db->query($sql);

			return isset($result[0]) ? $result[0] : null;
		}

//		public function getById($id)
//		{
//			$id = (int) $id;
//
//			$sql    = "select * from pages where id = '{$id}' limit 1";
//			$result = $this->db->query($sql);
//
//			return isset($result[0]) ? $result[0] : null;
//		}

		public function save($data, $id = null) {
			if ( !isset($data['alias']) || !isset($data['title']) || !isset($data['content'])) {
				return false;
			}

			$id = (int)$id;
			$alias = $this->db->escape($data['alias']);
			$title = $this->db->escape($data['title']);
			$content = $this->db->escape($data['content']);
			$is_published = isset($data['is_published']) ? 1 : 0;

			if (!$id) {
				$sql = "insert into pages 
								set alias = '{$alias}',
										title = '{$title}',
										content = '{$content}',
										is_published = {$is_published}
							";
			} else {
				$sql = "update pages 
								set alias = '{$alias}',
										title = '{$title}',
										content = '{$content}',
										is_published = {$is_published}
								where id = {$id}
							";
			}

			return $this->db->query($sql);
		}

		public function delete($id)
		{
			$id = (int)$id;
			$sql = "delete from pages where id = {$id} ";

			return $this->db->query($sql);
		}
	}