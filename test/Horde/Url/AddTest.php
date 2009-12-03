<?php
/**
 * @author     Jan Schneider <jan@horde.org>
 * @license    http://www.fsf.org/copyleft/lgpl.html LGPL
 * @category   Horde
 * @package    Horde_Url
 * @subpackage UnitTests
 */

class Horde_Url_AddTest extends PHPUnit_Framework_TestCase
{
    public function testAddSimple()
    {
        $url = new Horde_Url('test');
        $url->add('foo', 1);
        $this->assertEquals('test?foo=1', (string)$url);
        $url->add('bar', 2);
        $this->assertEquals('test?foo=1&amp;bar=2', (string)$url);
        $url->add('baz', 3);
        $this->assertEquals('test?foo=1&amp;bar=2&amp;baz=3', (string)$url);
    }

    public function testAddArray()
    {
        $url = new Horde_Url('test');
        $url->add(array('foo' => 1, 'bar' => 2));
        $this->assertEquals('test?foo=1&amp;bar=2', (string)$url);

        $url = new Horde_Url('test?foo=1');
        $url->add(array('bar' => 2, 'baz' => 3));
        $this->assertEquals('test?foo=1&amp;bar=2&amp;baz=3', (string)$url);
    }

    public function testAddToExistingUrl()
    {
        $url = new Horde_Url('test?foo=1&bar=2');
        $url->add(array('baz' => 3));
        $this->assertEquals('test?foo=1&bar=2&baz=3', (string)$url);

        $url = new Horde_Url('test?foo=1&bar=2');
        $url->add(array('foo' => 1, 'bar' => 3));
        $this->assertEquals('test?foo=1&bar=3', (string)$url);

        $url = new Horde_Url('test?foo=1&amp;bar=2');
        $url->add('baz', 3);
        $this->assertEquals('test?foo=1&amp;bar=2&amp;baz=3', (string)$url);
    }

    public function testAddRaw()
    {
        $url = new Horde_Url('test');
        $url->add('foo', 'bar&baz');
        $this->assertEquals('test?foo=bar%26baz', (string)$url);
        $url->add('x', 'y');
        $this->assertEquals('test?foo=bar%26baz&amp;x=y', (string)$url);
        $url->raw = true;
        $url->add('x', 'y');
        $this->assertEquals('test?foo=bar%26baz&x=y', (string)$url);

        $url = new Horde_Url('test');
        $url->add('x', 'y')
            ->add('foo', 'bar&baz');
        $this->assertEquals('test?x=y&amp;foo=bar%26baz', (string)$url);
    }

    public function testAddChaining()
    {
        $url = new Horde_Url('test');
        $url->add('foo', 1)
            ->add('bar', 2)
            ->add('baz', 3);
        $this->assertEquals('test?foo=1&amp;bar=2&amp;baz=3', (string)$url);
    }
}
