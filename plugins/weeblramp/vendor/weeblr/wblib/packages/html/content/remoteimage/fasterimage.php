<?php

/**
 * Derived from:
 *
 * FastImage - Because sometimes you just want the size!
 * Based on the Ruby Implementation by Steven Sykes (https://github.com/sdsykes/fastimage)
 *
 * Copyright (c) 2012 Tom Moor
 * Tom Moor, http://tommoor.com
 *
 * MIT Licensed
 * @version 0.1
 *
 * and
 *
 * FasterImage - Because sometimes you just want the size, and you want them in
 * parallel!
 *
 * Based on the PHP stream implementation by Tom Moor (http://tommoor.com)
 * which was based on the original Ruby Implementation by Steven Sykes
 * (https://github.com/sdsykes/fastimage)
 *
 * MIT Licensed
 *
 * @version 0.01
 */
class WblHtmlContentRemoteimage_FasterImage
{
	/**
	 * The default timeout
	 *
	 * @var int
	 */
	protected $timeout       = 5;
	protected $stream        = null;
	protected $parser        = null;
	protected $transportType = null;
	protected $transport     = null;

	/**
	 * Finds out which http transport we can use and initialize
	 * accordingly
	 *
	 * WblHtmlContentRemoteimage_FasterImage constructor.
	 */
	public function __construct($options = array())
	{
		if (!empty($options['timeout']))
		{
			$this->timeout = $options['timeouy'];
		}

		// get stream and parser
		$this->stream = new WblHtmlContentRemoteimage_Stream;
		$this->parser = new WblHtmlContentRemoteimage_Parser($this->stream);

		// determine which transport to use
		$this->discoverTransport()
			// initialize this transport
			 ->buildTransport()
		     ->setTimeout(
			     $this->timeout
		     );
	}

	protected function discoverTransport()
	{
		switch (true)
		{
			case (function_exists('curl_version') && curl_version()):
				$this->transportType = 'curl';
				break;
			case (function_exists('fopen') && is_callable('fopen') && ini_get('allow_url_fopen')):
				$this->transportType = 'stream';
				break;
		}
		return $this;
	}

	protected function buildTransport()
	{
		$className = 'WblHtmlContentRemoteimage_' . ucfirst($this->transportType) . 'transport';

		$this->transport = new $className(
			$this->stream,
			$this->parser
		);

		return $this->transport;
	}

	/**
	 * @param $url
	 * @param $result
	 *
	 * @return resource
	 */
	public function getSize($url)
	{
		$this->parser->reset();

		// fetch and get size
		$result = $this->transport->getSize($url);

		return $result;
	}
}
