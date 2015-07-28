<?php

namespace spec\Dgafka\AuthorizationSecurity\Application;

use Dgafka\AuthorizationSecurity\Application\CoreConfig;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\visitor\vfsStreamStructureVisitor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class CoreConfigSpec
 *
 * @package spec\Dgafka\AuthorizationSecurity\Application
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @mixin CoreConfig
 */
class CoreConfigSpec extends ObjectBehavior
{

    function it_should_create_config()
    {
        $root = vfsStream::setup('home');

        vfsStream::create(array(
            'project' => array(
                'src' => array()
            ),
        ), $root);

        $this->beConstructedWith(array(vfsStream::url('home/project/src')), vfsStream::url('home/project/cache'), true);

        $this->includePaths()->shouldReturn(array(vfsStream::url('home/project/src')));
        $this->cachePath()->shouldReturn(vfsStream::url('home/project/cache'));
        $this->debugMode()->shouldReturn(true);
    }

    function it_should_throw_exception_when_no_privileges()
    {
        $root = vfsStream::setup('home');
        $root->addChild(vfsStream::newDirectory('project'));

        $project = $root->getChild('project');
        $project->addChild(vfsStream::newDirectory('cache', 0000));

        $this->shouldThrow('\InvalidArgumentException')->during('__construct', [array(vfsStream::url('home/project/src')), vfsStream::url('home/project/cache'), true]);

        $root = vfsStream::setup('home');
        $root->addChild(vfsStream::newDirectory('project', 0000));

        $project = $root->getChild('project');
        $project->addChild(vfsStream::newDirectory('cache'));

        $this->shouldThrow('\InvalidArgumentException')->during('__construct', [array(vfsStream::url('home/project/src')), vfsStream::url('home/project/cache'), true]);
    }


    function it_should_throw_exception_if_when_not_bool_passed_as_debug()
    {
        $root = vfsStream::setup('home');

        vfsStream::create(array(
            'project' => array(
                'src' => array()
            ),
        ), $root);

        $this->shouldThrow('\InvalidArgumentException')->during('__construct', [array(vfsStream::url('home/project/src')), vfsStream::url('home/project/cache'), '1']);
    }


}
