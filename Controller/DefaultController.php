<?php

namespace ITN\Bundle\LogViewerBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Tac\Tac;


class DefaultController extends ContainerAware
{
    public function indexAction(Request $request, $env)
    {
        $logs_dir = $this->container->getParameter('kernel.logs_dir');
        $logfile = $logs_dir . DIRECTORY_SEPARATOR . $env . '.log';

        if (!file_exists($logfile)) {
            throw new NotFoundHttpException(sprintf('log file not found %s', $logfile));
        }

        return $this->container->get('templating')->renderResponse('ITNLogViewerBundle:Default:index.html.twig', array(
            'tac'   => new Tac($logfile),
            'env'   => $env,
            'file'  => $logfile,
            'lines' => (int) $request->query->get('lines', 1000),
        ));
    }
}
