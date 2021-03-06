<?php

if ( !class_exists( 'ICWP_WPSF_Processor_Base', false ) ):

	abstract class ICWP_WPSF_Processor_Base extends ICWP_WPSF_Foundation {

		/**
		 * @var ICWP_WPSF_FeatureHandler_Base
		 */
		protected $oFeatureOptions;

		/**
		 * @var int
		 */
		protected $nPromoNoticesCount = 0;

		/**
		 * @param ICWP_WPSF_FeatureHandler_Base $oFeatureOptions
		 */
		public function __construct( $oFeatureOptions ) {
			$this->oFeatureOptions = $oFeatureOptions;
			add_action( $oFeatureOptions->doPluginPrefix( 'plugin_shutdown' ), array( $this, 'action_doFeatureProcessorShutdown' ) );
			add_action( $oFeatureOptions->doPluginPrefix( 'generate_admin_notices' ), array( $this, 'autoAddToAdminNotices' ) );
			if ( method_exists( $this, 'addToAdminNotices' ) ) {
				add_action( $oFeatureOptions->doPluginPrefix( 'generate_admin_notices' ), array( $this, 'addToAdminNotices' ) );
			}
			$this->init();
		}

		/**
		 * @return ICWP_WPSF_Plugin_Controller
		 */
		public function getController() {
			return $this->getFeatureOptions()->getController();
		}

		public function autoAddToAdminNotices() {
			$oCon = $this->getController();

			foreach( $this->getFeatureOptions()->getAdminNotices() as $sNoticeId => $aNoticeAttributes ) {

				if ( !$this->getIfDisplayAdminNotice( $aNoticeAttributes ) ) {
					continue;
				}

				$sMethodName = 'addNotice_'.str_replace( '-', '_', $sNoticeId );
				if ( method_exists( $this, $sMethodName )
					&& isset( $aNoticeAttributes['valid_admin'] ) && $aNoticeAttributes['valid_admin'] && $oCon->getIsValidAdminArea() ) {

					$aNoticeAttributes[ 'notice_id' ] = $sNoticeId;
					call_user_func( array( $this, $sMethodName ), $aNoticeAttributes );
				}
			}
		}

		/**
		 * @param array $aNoticeAttributes
		 * @return bool
		 */
		protected function getIfDisplayAdminNotice( $aNoticeAttributes ) {
			$oWpNotices = $this->loadAdminNoticesProcessor();

			if ( empty( $aNoticeAttributes['schedule'] ) || !in_array( $aNoticeAttributes['schedule'], array( 'once', 'conditions', 'version' ) ) ) {
				$aNoticeAttributes[ 'schedule' ] = 'conditions';
			}

			if ( $aNoticeAttributes[ 'schedule' ] == 'once'
				&& ( !$this->loadWpUsersProcessor()->getCanAddUpdateCurrentUserMeta() || $oWpNotices->getAdminNoticeIsDismissed( $aNoticeAttributes['id'] ) )
			) {
				return false;
			}

			if ( $aNoticeAttributes['schedule'] == 'version' && ( $this->getFeatureOptions()->getVersion() == $oWpNotices->getAdminNoticeMeta( $aNoticeAttributes['id'] ) ) ) {
				return false;
			}

			if ( isset( $aNoticeAttributes['type'] ) && $aNoticeAttributes['type'] == 'promo' ) {
				if ( $this->nPromoNoticesCount > 0 || $this->loadWpFunctionsProcessor()->getIsMobile() ) {
					return false;
				}
				$this->nPromoNoticesCount++; // we limit the number of promos displayed at any time to 1
			}

			return true;
		}

		public function action_doFeatureProcessorShutdown() {}

		/**
		 * Resets the object values to be re-used anew
		 */
		public function init() {}

		/**
		 * @return bool
		 */
		protected function readyToRun() {
			return true;
		}

		/**
		 * Override to set what this processor does when it's "run"
		 */
		abstract public function run();

		/**
		 * @param array $aNoticeData
		 */
		protected function insertAdminNotice( $aNoticeData ) {
			$sRenderedNotice = $this->getFeatureOptions()->renderAdminNotice( $aNoticeData );
			if ( !empty( $sRenderedNotice ) ) {
				$this->loadAdminNoticesProcessor()->addAdminNotice(
					$sRenderedNotice,
					$aNoticeData['notice_attributes']['notice_id']
				);
			}
		}

		/**
		 * @param $sOptionKey
		 * @param mixed $mDefault
		 * @return mixed
		 */
		public function getOption( $sOptionKey, $mDefault = false ) {
			return $this->getFeatureOptions()->getOpt( $sOptionKey, $mDefault );
		}

		/**
		 * @param string $sKey
		 * @param mixed $mValueToTest
		 * @param boolean $bStrict
		 *
		 * @return bool
		 */
		public function getIsOption( $sKey, $mValueToTest, $bStrict = false ) {
			$mOptionValue = $this->getOption( $sKey );
			return $bStrict? $mOptionValue === $mValueToTest : $mOptionValue == $mValueToTest;
		}

		public function registerGoogleRecaptchaJs() {
			$sJsUri = add_query_arg(
				array( 'hl', $this->getGoogleRecaptchaLocale() ),
				'https://www.google.com/recaptcha/api.js'
			);
			wp_register_script( 'google-recaptcha', $sJsUri );
			wp_enqueue_script( 'google-recaptcha' );
		}

		/**
		 * We don't handle locale derivatives (yet)
		 * @return string
		 */
		protected function getGoogleRecaptchaLocale() {
			$aLocaleParts = explode( '_', $this->loadWpFunctionsProcessor()->getLocale(), 2 );
			return $aLocaleParts[ 0 ];
		}

		/**
		 * @return mixed
		 */
		public function getPluginDefaultRecipientAddress() {
			return apply_filters( $this->getFeatureOptions()->doPluginPrefix( 'report_email_address' ), $this->loadWpFunctionsProcessor()->getSiteAdminEmail() );
		}

		/**
		 * @return ICWP_WPSF_Processor_Email
		 */
		public function getEmailProcessor() {
			return $this->getFeatureOptions()->getEmailProcessor();
		}

		/**
		 * @return ICWP_WPSF_FeatureHandler_Base
		 */
		protected function getFeatureOptions() {
			return $this->oFeatureOptions;
		}

		/**
		 * @return bool|int|string
		 */
		protected function human_ip() {
			return $this->loadDataProcessor()->getVisitorIpAddress();
		}

		/**
		 * @return bool|int
		 */
		protected function ip() {
			return $this->loadDataProcessor()->getVisitorIpAddress( false );
		}

		/**
		 * @return int
		 */
		protected function time() {
			return $this->loadDataProcessor()->GetRequestTime();
		}
	}

endif;