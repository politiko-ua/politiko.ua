<?

load::app('modules/vybory2012/controller');
class vybory2012_index_action extends vybory2012_controller
{
	public function execute()
	{
		//$this->list = parties_peer::instance()->get_list();
		//$this->withoutphoto = parties_peer::instance()->get_list(array('rate'=>'0'));
		//$this->withoutphoto = parties_peer::instance()->get_list(array('photo_salt'=>''));
                //$this->list= array_diff($this->list, $this->withoutphoto);
                
                if (request::get('sort')=='votes'){
                    $this->voted = db::get_cols("SELECT party_id, count(*) AS count FROM votes2012  GROUP BY party_id ORDER BY count DESC");
                    $this->list = parties_peer::instance()->get_list(array('vybory_2012'=>'1'));
                    $this->list=array_unique(array_merge($this->voted,$this->list));
                }
                elseif (request::get('sort')=='rating'){
                    $this->list = parties_peer::instance()->get_list(array('vybory_2012'=>'1'), array(), array('rate DESC'));
                }
                
                elseif (request::get('sort')=='abc'){
                    $this->list = parties_peer::instance()->get_list(array('vybory_2012'=>'1'), array(), array('title ASC'));
                }
                else
                {
                
                    $this->list = parties_peer::instance()->get_list(array('vybory_2012'=>'1'));
                    shuffle($this->list);
                }
	}
}
