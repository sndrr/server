<?php

declare(strict_types=1);

/**
 * @copyright Copyright (c) 2016, ownCloud, Inc.
 *
 * @author Arthur Schiwon <blizzz@arthur-schiwon.de>
 * @author Lukas Reschke <lukas@statuscode.ch>
 *
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program. If not, see <http://www.gnu.org/licenses/>
 *
 */

namespace OCP\App;

use OCP\EventDispatcher\Event;
use OCP\IGroup;

/**
 * @since 9.0.0
 */
class ManagerEvent extends Event {

	const EVENT_APP_ENABLE = 'OCP\App\IAppManager::enableApp';
	const EVENT_APP_ENABLE_FOR_GROUPS = 'OCP\App\IAppManager::enableAppForGroups';
	const EVENT_APP_DISABLE = 'OCP\App\IAppManager::disableApp';

	/**
	 * @since 9.1.0
	 */
	const EVENT_APP_UPDATE = 'OCP\App\IAppManager::updateApp';

	/** @var string */
	protected $event;
	/** @var string */
	protected $appID;
	/** @var IGroup[]|null */
	protected $groups;

	/**
	 * DispatcherEvent constructor.
	 *
	 * @param string $event
	 * @param string $appID
	 * @param IGroup[]|null $groups
	 * @since 9.0.0
	 */
	public function __construct(string $event, string $appID, array $groups = null) {
		parent::__construct();
		$this->event = $event;
		$this->appID = $appID;
		$this->groups = $groups;
	}

	/**
	 * @return string
	 * @since 9.0.0
	 */
	public function getEvent() {
		return $this->event;
	}

	/**
	 * @return string
	 * @since 9.0.0
	 */
	public function getAppID() {
		return $this->appID;
	}

	/**
	 * returns the group Ids
	 * @return string[]
	 * @since 9.0.0
	 */
	public function getGroups() {
		return array_map(function ($group) {
			/** @var IGroup $group */
			return $group->getGID();
		}, $this->groups);
	}
}
