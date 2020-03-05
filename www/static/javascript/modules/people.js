var peopleController = new function()
{
	this.indexAction = function()
	{
		swfobject.embedSWF(
			'/chart.swf',
			'direction_graph',
			240,
			240,
			'9.0.0',
			'expressInstall.swf',
			{'data-file': '/people/political_views'}
		);
	};

	this.chartSelectView = function( id )
	{
		alert( 'Вы выбрали: ' + id);
	}
};