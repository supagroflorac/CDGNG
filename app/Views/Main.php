<?php
namespace CDGNG\Views;

class Main extends TwigView
{
    protected function getTemplateFilename()
    {
        return 'main.twig';
    }

    public function checkParameters()
    {
        // Rien.
    }

    protected function getData()
    {
        $messages = new \CDGNG\Messages();

        return array(
            'pageTitle' => "CDG",
            'actions' => $this->model->actions,
            'modes' => $this->model->modes,
            'calendars' => $this->model->calendars,
            'connectedUser' => $this->model->users->connected,
            'messages' => $messages->getAll(),
        );
    }
}
