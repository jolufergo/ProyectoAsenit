<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\Adapter;


class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    
    
    
    public function trabajadoresAction()
    {
    	$this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');
    	$result = $this->dbAdapter->query("select nombre_trabajador,apellido_trabajador,puesto_trabajador,nombre_proyecto,estado_proyecto
    			from trabajador
inner join trabaja on trabaja.trabajador=trabajador.id_trabajador inner join proyecto on proyecto.id_proyecto=trabaja.proyecto
order by nombre_trabajador",Adapter::QUERY_MODE_EXECUTE);
    	$datos =$result->toArray();
    	return new ViewModel(array('titulo'=>"Trabajadores de la Empresa",'datos'=>$datos));
    }
    
   
    
    public function proyectosAction()
    {
    	$this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');
    	$result = $this->dbAdapter->query("select nombre_proyecto,estado_proyecto,nombre_trabajador,apellido_trabajador,puesto_trabajador
    			from proyecto
    			inner join trabaja on trabaja.proyecto=proyecto.id_proyecto inner join trabajador on trabajador.id_trabajador = trabaja.trabajador
    			where trabaja.trabajador = trabajador.ID_trabajador and trabaja.proyecto = proyecto.ID_proyecto
    			 order by nombre_proyecto",Adapter::QUERY_MODE_EXECUTE);
    	$datos =$result->toArray();
    	return new ViewModel(array('titulo'=>"Proyectos de la Empresa",'datos'=>$datos));
    }
}
