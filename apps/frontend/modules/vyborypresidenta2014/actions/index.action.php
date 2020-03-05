<?

load::app('modules/vyborypresidenta2014/controller');
class vyborypresidenta2014_index_action extends vyborypresidenta2014_controller
{
	public function execute()
	{
		//$this->list = user_data_peer::instance()->get_list();
		//$this->withoutphoto = user_data_peer::instance()->get_list(array('rate'=>'0'));
		//$this->withoutphoto = user_data_peer::instance()->get_list(array('photo_salt'=>''));
                //$this->list= array_diff($this->list, $this->withoutphoto);
                
                if (request::get('sort')=='votes'){
                    $this->voted = db::get_cols("SELECT president_id, count(*) AS count FROM votes2014  GROUP BY president_id ORDER BY count DESC");
                    $this->list = user_data_peer::instance()->get_list(array('vybory_2014'=>'1'));
                    $this->list=array_unique(array_merge($this->voted,$this->list));
                }
                elseif (request::get('sort')=='rating'){
                    $this->list = user_data_peer::instance()->get_list(array('vybory_2014'=>'1'), array(), array('rate DESC'));
                }
                
                elseif (request::get('sort')=='abc'){
                    $this->list = user_data_peer::instance()->get_list(array('vybory_2014'=>'1'), array(), array('last_name ASC'));
                }
                else
                {
                
                    $this->list = user_data_peer::instance()->get_list(array('vybory_2014'=>'1'));
                    shuffle($this->list);
                }
	}
}
