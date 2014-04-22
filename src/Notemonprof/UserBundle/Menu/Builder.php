<?php

use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
public function mainMenu(FactoryInterface $factory, array $options)
{
$menu = $factory->createItem('root');

$menu->addChild('Home', array('route' => 'homepage'));
$menu->addChild('About Me', array(
'route' => 'page_show',
'routeParameters' => array('id' => 42)
));
// ... add more children

return $menu;
}
}