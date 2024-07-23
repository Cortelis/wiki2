<?php

namespace MediaWiki\Extension\Thanks;

use EchoAttributeManager;
use EchoUserLocator;
use ExtensionRegistry;
use MediaWiki\Extension\Notifications\Hooks\BeforeCreateEchoEventHook;
use MediaWiki\Extension\Notifications\Hooks\EchoGetBundleRulesHook;
use MediaWiki\Extension\Notifications\Model\Event;

/**
 * Hooks for Thanks extension
 *
 * @file
 * @ingroup Extensions
 */
class EchoHooks implements BeforeCreateEchoEventHook, EchoGetBundleRulesHook {

	/**
	 * Add Thanks events to Echo
	 *
	 * @param array &$notifications array of Echo notifications
	 * @param array &$notificationCategories array of Echo notification categories
	 * @param array &$icons array of icon details
	 */
	public function onBeforeCreateEchoEvent(
		array &$notifications, array &$notificationCategories, array &$icons
	) {
		$notificationCategories['edit-thank'] = [
			'priority' => 3,
			'tooltip' => 'echo-pref-tooltip-edit-thank',
		];

		$notifications['edit-thank'] = [
			// The following message is generated by the category name:
			// * echo-category-title-edit-thank
			'category' => 'edit-thank',
			'group' => 'positive',
			'section' => 'message',
			'presentation-model' => EchoCoreThanksPresentationModel::class,
			'bundle' => [
				'web' => true,
				'expandable' => true,
			],
			EchoAttributeManager::ATTR_LOCATORS => [
				[
					[ EchoUserLocator::class, 'locateFromEventExtra' ],
					[ 'thanked-user-id' ]
				],
			],
		];

		if ( ExtensionRegistry::getInstance()->isLoaded( 'Flow' ) ) {
			$notifications['flow-thank'] = [
				'category' => 'edit-thank',
				'group' => 'positive',
				'section' => 'message',
				'presentation-model' => EchoFlowThanksPresentationModel::class,
				'bundle' => [
					'web' => true,
					'expandable' => true,
				],
				EchoAttributeManager::ATTR_LOCATORS => [
					[
						[ EchoUserLocator::class, 'locateFromEventExtra' ],
						[ 'thanked-user-id' ]
					],
				],
			];
		}

		$icons['thanks'] = [
			'path' => [
				'ltr' => 'Thanks/modules/userTalk-constructive-ltr.svg',
				'rtl' => 'Thanks/modules/userTalk-constructive-rtl.svg'
			]
		];
	}

	/**
	 * Handler for EchoGetBundleRule hook, which defines the bundle rules for each notification.
	 *
	 * @param Event $event The event being notified.
	 * @param string &$bundleString Determines how the notification should be bundled.
	 */
	public function onEchoGetBundleRules( Event $event, string &$bundleString ) {
		switch ( $event->getType() ) {
			case 'edit-thank':
				$bundleString = 'edit-thank';
				// Try to get either the revid or logid parameter.
				$revOrLogId = $event->getExtraParam( 'logid' );
				if ( $revOrLogId ) {
					// avoid collision with revision ids
					$revOrLogId = 'log' . $revOrLogId;
				} else {
					$revOrLogId = $event->getExtraParam( 'revid' );
				}
				if ( $revOrLogId ) {
					$bundleString .= $revOrLogId;
				}
				break;
			case 'flow-thank':
				$bundleString = 'flow-thank';
				$postId = $event->getExtraParam( 'post-id' );
				if ( $postId ) {
					$bundleString .= $postId;
				}
				break;
		}
	}

}
