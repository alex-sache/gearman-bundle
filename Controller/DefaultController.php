<?php

namespace GearmanBundle\Controller;

use GearmanBundle\Service\GearmanClient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        /** @var GearmanClient $gearman */
        $gearman = $this->get('gearman');

        $result = $gearman
            ->doJob('GearmanBundleWorkersFirstWorker~testA', 'value1');

        $returnCode = $gearman->getReturnCode();

        var_dump($result);
        var_dump($returnCode);

        die();
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }

    public function showAction()
    {
        /** @var GearmanClient $gearman */
        $gearman = $this->get('gearman');

        $result = $gearman->doHighJob('GearmanBundleWorkersFirstWorker~testB', 'value1');

        $returnCode = $gearman->getReturnCode();

        var_dump($result);
        var_dump($returnCode);

        die();
    }
}
