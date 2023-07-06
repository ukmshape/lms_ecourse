<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); 

/**

 * This class extends the core Encrypt class, and allows you

 * to use encrypted strings in your URLs.

 */

class MY_Encryption extends CI_Encryption

{

	/**

	 * Encodes a string.

	 *

	 * @param string $string The string to encrypt.

	 * @param string $key[optional] The key to encrypt with.

	 * @param bool $url_safe[optional] Specifies whether or not the

	 *                returned string should be url-safe.

	 * @return string

	 */

	function encrypt($data, array $params = NULL)

	{

		$ret = parent::encrypt($data, $params);



		$ret = strtr(

				$ret,

				array(

					'+' => '.',

					'=' => '-',

					'/' => '~'

				)

			);



		return $ret;

	}



	/**

	 * Decodes the given string.

	 *

	 * @access public

	 * @param string $string The encrypted string to decrypt.

	 * @param string $key[optional] The key to use for decryption.

	 * @return string

	 */

	function decrypt($data, array $params = NULL)

	{

		$data = strtr(

				$data,

				array(

					'.' => '+',

					'-' => '=',

					'~' => '/'

				)

			);



		return parent::decrypt($data, $params);

	}

}



/* End of file MY_Encrypt.php */

/* Location: ./application/libraries/MY_Encrypt.php */