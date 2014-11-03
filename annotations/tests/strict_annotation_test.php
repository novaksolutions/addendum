<?php
	require_once('simpletest/autorun.php');
	require_once(dirname(__FILE__).'/../../annotations.php');

	/** @UnknownAnnotation */
    class BadlyAnnotatedClass1 {

	}

    /** @Bob\UnknownAnnotation */
    class BadlyAnnotatedClass2 {

    }

    /** @return "" */
    class BadlyAnnotatedClass3 {

    }



	class TestOfUnknownAnnotations extends UnitTestCase {
        public function setUp(){
            Addendum::strict(true);
        }

		public function testClassAnnotationThrowsErrorWhenUnknownAnnotation() {
			$this->expectException(new Exception("Error, unknown Annotation: UnknownAnnotation"));
			$reflection = new ReflectionAnnotatedClass('BadlyAnnotatedClass1');
		}

        public function testClassAnnotationThrowsErrorWhenUnknownNamespacedAnnotation() {
            $this->expectException(new Exception("Error, unknown Annotation: Bob\\UnknownAnnotation"));
            $reflection = new ReflectionAnnotatedClass('BadlyAnnotatedClass2');
        }

        public function testClassAnnotationDoesntThrowsErrorWhenDocBlockGiven() {
            $reflection = new ReflectionAnnotatedClass('BadlyAnnotatedClass3');
        }

        public function tearDown(){
            Addendum::strict(false);
        }
	}
?>
