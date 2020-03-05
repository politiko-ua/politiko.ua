<? $menu = array(
	'/blogs' => array( t('Блоги'), t('Блоги') ),
	'/debates' => array( t('Дебаты'), t('Обсуждение актуальных вопросов') ),
	'/polls' => array( t('Опросы'), t('Задай вопрос сообществу Политико') ),
	'/parties' => array( t('Партии'), t('Рейтинг политических партий') ),
	'/people' => array( t('Люди'), t('Рейтинг политиков. Оцени их политику') ),
	'/groups' => array( t('Группы'), t('Сообщества Политико') ),
	'/ideas' => array( t('Идеи'), t('Обсуждения идей') ),
    '/search' => array( t('Поиск'), t('Поиск по сайту') ),
); ?>

<div class="mt5">
<? foreach ( $menu as $url => $menu_data ) {
	$title = $menu_data[0];
	$alt = $menu_data[1];
	echo "<a title=\"{$alt}\" href=\"https://" . context::get('server') . "{$url}\" class=\"" . trim($url, '/') . ( $selected_menu == $url ? ' selected' : '' ) . "\">" . tag_helper::image('menu/' . trim($url, '/') . '.png', array('class' => 'mr5 vcenter', 'alt' => $title)) . "{$title}</a>";
} ?>

</div>
