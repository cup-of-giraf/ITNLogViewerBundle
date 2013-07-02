<?php

namespace ITN\Bundle\LogViewerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/{env}")
     * @Template()
     */
    public function indexAction( $env)
    {
        $root_dir = $this->get('kernel')->getRootDir();
        $logfile = $root_dir. DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . $env . '.log';

        if( file_exists($logfile) == false ) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException( sprintf('log file not found %s', $logfile));
        }

        $tac = new \Tac\Tac($logfile);

        return array('tac' => $tac);
    }
}
