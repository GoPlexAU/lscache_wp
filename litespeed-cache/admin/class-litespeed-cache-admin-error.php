<?php



/**
 * The admin errors
 *
 *
 * @since      1.0.15
 * @package    LiteSpeed_Cache
 * @subpackage LiteSpeed_Cache/admin
 * @author     LiteSpeed Technologies <info@litespeedtech.com>
 */
class LiteSpeed_Cache_Admin_Error
{
	private static $instance;

	const NOTICE_BLUE = 'notice notice-info';
	const NOTICE_GREEN = 'notice notice-success';
	const NOTICE_RED = 'notice notice-error';
	const NOTICE_YELLOW = 'notice notice-warning';
	const E_PHP_VER = 1000;
	const E_WP_VER = 1010;

	const E_PURGE_FORM = 2000;
	const E_PURGEBY_EMPTY = 2010;
	const E_PURGEBY_BAD = 2020;
	const E_PURGEBY_CAT_INV = 2030;
	const E_PURGEBY_TAG_INV = 2040;
	const E_PURGEBY_URL_BAD = 2050;

	const E_PURGEBY_PID_NUM = 2500;
	const E_PURGEBY_PID_DNE = 2510;
	const E_PURGEBY_URL_INV = 2520;
	const E_PURGEBY_CAT_DNE = 2530;
	const E_PURGEBY_TAG_DNE = 2540;

	const E_SETTING_ADMIN_IP_INV = 3000;
	const E_SETTING_TEST_IP_INV = 3010;

	const E_SETTING_TTL = 3500;
	const E_SETTING_CAT = 3510;
	const E_SETTING_TAG = 3520;
	const E_SETTING_LC = 3530; // login cookie setting
	const E_SETTING_REWRITE = 3540;
	const E_SETTING_OVERWRITE = 3550;

	const E_LC_HTA = 4000; // login cookie .htaccess not correct

	const E_HTA_DNF = 4500; // .htaccess did not find.

	const E_LC_MISMATCH = 5000; // login cookie mismatch

	const E_SERVER = 6000;

	const E_CONF = 9000; // general config failed to write.
	const E_HTA_BU = 9010; // backup
	const E_HTA_DNE = 9020; // does not exist
	const E_HTA_PUT = 9030; // failed to put
	const E_HTA_GET = 9040; // failed to get
	const E_HTA_RW = 9050; // read write
	const E_HTA_ORDER = 9060; // prefix found after suffix
	const E_CONF_WRITE = 9070;
	const E_CONF_FIND = 9080;

	private $notices = array();

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.7
	 * @access   private
	 */
	private function __construct()
	{
	}

	/**
	 * Get the LiteSpeed_Cache_Admin_Error object.
	 *
	 * @since 1.0.7
	 * @access public
	 * @return LiteSpeed_Cache_Admin_Error Static instance of the
	 *  LiteSpeed_Cache_Admin_Display class.
	 */
	public static function get_instance()
	{
		if (!isset(self::$instance)) {
			self::$instance = new LiteSpeed_Cache_Admin_Error();
		}

		return self::$instance;
	}

	private function _get($err_code)
	{

		switch ($err_code)
		{
		case self::E_PHP_VER:
			return '<strong>'
				. __('The installed PHP version is too old for the LiteSpeed Cache Plugin.', 'litespeed-cache')
				. '</strong><br /> '
				. sprintf(__('The LiteSpeed Cache Plugin requires at least PHP %s.', 'litespeed-cache'), '5.3')
				. ' '
				. sprintf(__('The currently installed version is PHP %s, which is out-dated and insecure.', 'litespeed-cache'), PHP_VERSION)
				. ' '
				. sprintf(wp_kses(__('Please upgrade or go to <a href="%s">active plugins</a> and deactivate the LiteSpeed Cache plugin to hide this message.', 'litespeed-cache'),
					array('a' => array('href' => array()))), 'plugins.php?plugin_status=active');
		case self::E_WP_VER:
			return '<strong>'
				. __('The installed WordPress version is too old for the LiteSpeed Cache Plugin.', 'litespeed-cache')
				. '</strong><br />'
				. sprintf(__('The LiteSpeed Cache Plugin requires at least WordPress %s.', 'litespeed-cache'), '3.3')
				. ' '
				. sprintf(wp_kses(__('Please upgrade or go to <a href="%s">active plugins</a> and deactivate the LiteSpeed Cache plugin to hide this message.', 'litespeed-cache'),
					array('a' => array('href' => array()))), 'plugins.php?plugin_status=active');
		// Admin action errors.
		case self::E_PURGE_FORM:
			return __('Something went wrong with the form! Please try again.', 'litespeed-cache');
		case self::E_PURGEBY_EMPTY:
			return __('Tried to purge list with empty list.', 'litespeed-cache');
		case self::E_PURGEBY_BAD:
			return __('Bad Purge By selected value.', 'litespeed-cache');
		case self::E_PURGEBY_CAT_INV:
			return __('Failed to purge by category, invalid category slug.', 'litespeed-cache');
		case self::E_PURGEBY_TAG_INV:
			return __('Failed to purge by tag, invalid tag slug.', 'litespeed-cache');
		case self::E_PURGEBY_URL_BAD:
			return __('Failed to purge by url, contained "<".', 'litespeed-cache');

		// Admin actions with expected parameters for message.
		case self::E_PURGEBY_PID_NUM:
			return __('Failed to purge by Post ID, given ID is not numeric: %s', 'litespeed-cache');
		case self::E_PURGEBY_PID_DNE:
			return __('Failed to purge by Post ID, given ID does not exist or is not published: %s',
				'litespeed-cache');
		case self::E_PURGEBY_URL_INV:
			return __('Failed to purge by url, invalid input: %s.', 'litespeed-cache');
		case self::E_PURGEBY_CAT_DNE:
			return __('Failed to purge by category, does not exist: %s', 'litespeed-cache');
		case self::E_PURGEBY_TAG_DNE:
			return __('Failed to purge by tag, does not exist: %s', 'litespeed-cache');

		// Admin settings errors.
		case self::E_SETTING_ADMIN_IP_INV:
			return __('Invalid data in Admin IPs.', 'litespeed-cache');
		case self::E_SETTING_TEST_IP_INV:
			return __('Invalid data in Test IPs.', 'litespeed-cache');

		// Admin settings with expected parameters for message.
		case self::E_SETTING_TTL:
			// %1 is the name of the TTL, %2 is the minimum integer allowed.
			return __('%1$s TTL must be an integer between %2$d and 2147483647',
				'litespeed-cache');
		case self::E_SETTING_CAT:
			// %s is the category attempted to be added.
			return __('Removed category "%s" from list, ID does not exist.',
				'litespeed-cache');
		case self::E_SETTING_TAG:
			// %s is the tag attempted to be added.
			return __('Removed tag "%s" from list, ID does not exist.',
				'litespeed-cache');
		case self::E_SETTING_LC:
			return __('Invalid login cookie. Invalid characters found: %s',
				'litespeed-cache');
		case self::E_SETTING_REWRITE:
			return __('Invalid Rewrite List. Empty or invalid rule. Rule: %s', 'litespeed-cache');
		case self::E_SETTING_OVERWRITE:
			return sprintf(__('Failed to overwrite %s.', 'litespeed-cache'),
				'.htaccess');

		// Login cookie in settings did not match .htaccess.
		case self::E_LC_HTA:
			return LiteSpeed_Cache_Admin_Display::build_paragraph(
				__('Tried to parse for existing login cookie.', 'litespeed-cache'),
				sprintf(__('%s file not valid. Please verify contents.',
					'litespeed-cache'), '.htaccess')
			);

		// Could not find something in the .htaccess file. Expect parameter.
		case self::E_HTA_DNF:
			return __('Could not find %s.', 'litespeed-cache');

		// Mismatched login cookie.
		case self::E_LC_MISMATCH:
			return LiteSpeed_Cache_Admin_Display::build_paragraph(
				__('This site is a subdirectory install.', 'litespeed-cache'),
				__('Login cookies do not match.', 'litespeed-cache'),
				__('Please remove both and set the login cookie in LiteSpeed Cache advanced settings.',
					'litespeed-cache'));

		// Either running another server or doesn't have cache module.
		case self::E_SERVER:
			return LiteSpeed_Cache_Admin_Display::build_paragraph(
				__('Notice: This plugin requires a LiteSpeed Server with the LSCache Module enabled.', 'litespeed-cache'),
				__('If you are unable to change your server stack, please contact your hosting provider to request the required changes.', 'litespeed-cache'),
				__('This plugin will NOT work properly.', 'litespeed-cache')
			);
		case self::E_CONF:
			return LiteSpeed_Cache_Admin_Display::build_paragraph(
				__('LiteSpeed Cache was unable to write to the wp-config.php file.', 'litespeed-cache'),
				sprintf(__('Please add the following to the wp-config.php file: %s', 'litespeed-cache'),
					'<br><pre>define(\'WP_CACHE\', true);</pre>')
			);

		// .htaccess problem.
		case self::E_HTA_BU:
			return __('Failed to back up file, aborted changes.', 'litespeed-cache');
		case self::E_HTA_DNE:
			return __('.htaccess file does not exist or is not readable.', 'litespeed-cache');
		case self::E_HTA_PUT:
			return sprintf(__('Failed to put contents into %s', 'litespeed-cache'),
				'.htaccess');
		case self::E_HTA_GET:
			return sprintf(__('Failed to get %s file contents.', 'litespeed-cache'),
				'.htaccess');
		case self::E_HTA_RW:
			return sprintf(__('%s file not readable or not writable.', 'litespeed-cache'),
				'.htaccess');
		case self::E_HTA_ORDER:
			return __('Prefix was found after suffix.', 'litespeed-cache');


		// wp-config problem.
		case self::E_CONF_WRITE:
			$err = sprintf(__('The %1$s file not writeable for %2$s', 'litespeed-cache'),
					'wp-config', '\'WP_CACHE\'');
			break;
		case self::E_CONF_FIND:
			$err = sprintf(__('%s file did not find a place to insert define.', 'litespeed-cache'),
					'wp-config');
			break;
		default:
			return '';
		}

		return $err . '<br>'
			. LiteSpeed_Cache_Admin_Display::build_paragraph(
				__('LiteSpeed Cache was unable to write to the wp-config.php file.', 'litespeed-cache'),
				sprintf(__('Please add the following to the wp-config.php file: %s', 'litespeed-cache'),
					'<br><pre>define(\'WP_CACHE\', true);</pre>')
			);
	}

	public static function get_error($err_code)
	{
		if (!is_numeric($err_code)) {
			return '';
		}
		return self::get_instance()->_get($err_code);
	}

	public static function build_error($err_code, $args)
	{
		if (!is_numeric($err_code)) {
			return '';
		}
		$error = self::get_instance()->_get($err_code);
		if (empty($error)) {
			return '';
		}
		elseif (is_array($args)) {
			return vsprintf($error, $args);
		}
		return sprintf($error, $args);
	}

	// assume red for now.
	public static function add_error($err_code, $args = null)
	{
		if (!is_null($args)) {
			$error = self::build_error($err_code, $args);
		}
		else {
			$error = self::get_error($err_code);
		}
		if (empty($error)) {
			return;
		}

		$errors = self::get_instance();

		if (empty($errors->notices)) {
			add_action(
				(is_network_admin() ? 'network_admin_notices' : 'admin_notices'),
				array($errors, 'display_errors'));
		}

		$errors->notices[] =
			'<div class="notice notice-error is-dismissible"><p>ERROR '
			. $err_code . ': '
			. $error . '</p></div>';
	}

	public function display_errors()
	{
		foreach ($this->notices as $msg) {
			echo $msg;
		}
	}

}
