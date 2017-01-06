<?php
/**
 * webtrees: online genealogy
 * Copyright (C) 2017 webtrees development team
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
namespace Fisharebest\Webtrees\Census;

use Fisharebest\Webtrees\Date;
use Fisharebest\Webtrees\Individual;

/**
 * The number of children who are still living.
 */
class CensusColumnChildrenLiving extends AbstractCensusColumn implements CensusColumnInterface {
	/**
	 * Generate the likely value of this census column, based on available information.
	 *
	 * @param Individual      $individual
	 * @param Individual|null $head
	 *
	 * @return string
	 */
	public function generate(Individual $individual, Individual $head = null) {
		if ($individual->getSex() !== 'F') {
			return '';
		}

		$count = 0;
		foreach ($individual->getSpouseFamilies() as $family) {
			foreach ($family->getChildren() as $child) {
				if (
					$child->getBirthDate()->isOK() &&
					Date::compare($child->getBirthDate(), $this->date()) < 0 &&
					$child->getBirthDate() != $child->getDeathDate() &&
					(!$child->getDeathDate()->isOK() || Date::compare($child->getDeathDate(), $this->date()) > 0)
				) {
					$count++;
				}
			}
		}

		return (string) $count;
	}
}
