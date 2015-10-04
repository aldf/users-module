<?php namespace Anomaly\UsersModule\User\Command;

use Anomaly\Streams\Platform\Addon\Plugin\PluginForm;
use Anomaly\Streams\Platform\Support\Decorator;
use Anomaly\UsersModule\User\Login\LoginFormBuilder;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class BuildLoginForm
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\UsersModule\User\Command
 */
class BuildLoginForm implements SelfHandling
{

    /**
     * The form parameters.
     *
     * @var array
     */
    protected $parameters;

    /**
     * Create a new BuildLoginForm instance.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    /**
     * Handle the command.
     *
     * @param PluginForm $form
     * @param Decorator  $decorator
     * @return \Anomaly\Streams\Platform\Ui\Form\FormBuilder
     */
    public function handle(PluginForm $form, Decorator $decorator)
    {
        $parameters = array_merge_recursive($this->parameters, ['builder' => LoginFormBuilder::class]);

        return $decorator->decorate($form->make($parameters)->getForm());
    }
}
