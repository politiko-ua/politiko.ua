<?

load::app('modules/admin/controller');
class admin_election_action extends admin_controller
{
	public function execute()
	{
		if ( $_POST )
		{
			$data = "
<?
\$rrating = array(
	102390 => " . (float)$_POST['votes'][102390] . ",
	102398 => " . (float)$_POST['votes'][102398] . ",
	0 => " . (float)$_POST['votes'][0] . ",
);

\$buletens = " . (float)$_POST['buletens'] . ";
";

			file_put_contents('/var/www/politiko/data/cvk.php', $data);
		}
	}
}
