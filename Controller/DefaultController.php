<?php

namespace ITN\Bundle\LogViewerBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Tac\Tac;


class DefaultController extends Controller
{
    /**
     * @Route("/{env}")
     * @Template()
     */
    public function indexAction($env)
    {
        $logs_dir = $this->container->getParameter('kernel.logs_dir');
        $logfile = $logs_dir . DIRECTORY_SEPARATOR . $env . '.log';

        if (!file_exists($logfile)) {
            throw $this->createNotFoundException(sprintf('log file not found %s', $logfile));
        }

        return array(
            'tac'   => new Tac($logfile),
            'env'   => $env,
            'file'  => $logfile,
            'lines' => (int) $this->getRequest()->query->get('lines', 1000),
        );
    }
}
