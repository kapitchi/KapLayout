<?php
/**
 * Kapitchi Zend Framework 2 Modules (http://kapitchi.com/)
 *
 * @copyright Copyright (c) 2012-2013 Kapitchi Open Source Team (http://kapitchi.com/open-source-team)
 * @license   http://opensource.org/licenses/LGPL-3.0 LGPL 3.0
 */

namespace KapLayout;

use Zend\ModuleManager\Feature\ControllerProviderInterface,
    Zend\EventManager\EventInterface,
    Zend\ModuleManager\Feature\ServiceProviderInterface,
    Zend\ModuleManager\Feature\ViewHelperProviderInterface,
    KapitchiBase\ModuleManager\AbstractModule,
    KapitchiEntity\Mapper\EntityDbAdapterMapperOptions,
    KapitchiEntity\Mapper\EntityDbAdapterMapper;

class Module extends AbstractModule {
    
     public function getControllerConfig() {
        return array(
            'factories' => array(
                //API
                     //ViewModel
                 'KapLayout\Controller\Api\ViewModel' => function($sm) {
                    $cont = new Controller\Api\ViewModelRestfulController(
                        $sm->getServiceLocator()->get('KapLayout\Service\ViewModel')
                    );
                    return $cont;
                },
                   
            )
        );
    }
    
     public function getViewHelperConfig() {
        return array(
             'factories' => array(
                //viewModel
                'layoutViewModel' => function($sm) {
                    $ins = new View\Helper\LayoutViewModel(
                        $sm->getServiceLocator()->get('KapLayout\Service\ViewModel')
                    );
                    return $ins;
                },
                
            )
        );
    }
    
     public function getServiceConfig() {
        return array(
            'invokables' => array(
                'KapLayout\Entity\ViewModel' => 'KapLayout\Entity\Viewmodel',
            ),
            'factories' => array(
                //ViewModel
                'KapLayout\Service\ViewModel' => function ($sm) {
                    $s = new Service\Layout(
                        $sm->get('KapLayout\Mapper\ViewModelDbAdapter'),
                        $sm->get('KapLayout\Entity\ViewModel'),
                        $sm->get('KapLayout\Entity\ViewModelHydrator')
                    );
                    return $s;
                },
                'KapLayout\Mapper\ViewModelDbAdapter' => function ($sm) {
                    return new EntityDbAdapterMapper(
                        $sm->get('Zend\Db\Adapter\Adapter'),
                        $sm->get('KapLayout\Entity\ViewModel'),
                        $sm->get('KapLayout\Entity\ViewModelHydrator'),    
                        'layout_view_model'
                    );
                },
                'KapLayout\Entity\ViewModelHydrator' => function ($sm) {
                    //needed here because hydrator tranforms camelcase to underscore
                    return new \Zend\Stdlib\Hydrator\ClassMethods(false);
                },
            )
        );
    }

    public function onBootstrap(EventInterface $e) {
        parent::onBootstrap($e);
    }
    
    
    public function getDir() {
        return __DIR__;
    }

    public function getNamespace() {
        return __NAMESPACE__;
    }

}