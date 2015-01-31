<?php
namespace Bolt\Tests\Extensions;

use Bolt\Tests\BoltUnitTest;
use Bolt\BaseExtension;

/**
 * Class to test src/BaseExtension.
 *
 * @author Ross Riley <riley.ross@gmail.com>
 *
 */
class BaseExtensionTest extends BoltUnitTest
{

    public function testSetup()
    {
        $app = $this->getApp();
        $ext = $this->getMock('Bolt\BaseExtension', null ,array($app));
        $this->assertNotEmpty($ext->getBasePath());
        $this->assertNotEmpty($ext->getBaseUrl());
        $this->assertEquals('mockobject', $ext->getMachineName());
    }

    /**
    * @runInSeparateProcess
    */
    public function testComposerLoading()
    {
        $app = $this->makeApp();
        $app['resources']->setPath('extensions', __DIR__."/resources");
        $app->initialize();
        $this->assertTrue($app['extensions']->isEnabled('testlocal'));
        $config = $app['extensions.testlocal']->getExtensionConfig();
        $this->assertNotEmpty($config);
    }
    
    public function testGetBasePath()
    {
        $app = $this->makeApp();
        $ext = $this->getMock('Bolt\BaseExtension', null, array($app));
        $this->assertNotEmpty(strpos($ext->getBasePath()->string(), 'MockObject'));
    }
    
    public function testGetBaseUrl()
    {
        $app = $this->makeApp();
        $ext = $this->getMock('Bolt\BaseExtension', null, array($app));
        $this->assertEquals(0, strpos($ext->getBaseUrl(), '/extensions') );
    }
    
    public function testGetComposerNameDefault()
    {
        $app = $this->makeApp();
        $ext = $this->getMock('Bolt\BaseExtension', null, array($app));
        $this->assertNull($ext->getComposerName());
    }
    
    public function testGetComposerName()
    {
        $app = $this->makeApp();
        $ext = $this->getMock('Bolt\BaseExtension', array('getComposerJSON'), array($app));
        $ext->expects($this->any())
            ->method('getComposerJSON')
            ->will($this->returnValue(array('name'=>'valuefrommock')));
        
        //$this->assertEquals('valuefrommock', $ext->getComposerName());
    }
    
    public function testGetMachineName()
    {
        $app = $this->makeApp();
        $ext = $this->getMock('Bolt\BaseExtension', null, array($app));
        
        // Machine name calculated from the Class name in this case MockObject
        $this->assertEquals('mockobject', $ext->getMachineName());
    }

}
