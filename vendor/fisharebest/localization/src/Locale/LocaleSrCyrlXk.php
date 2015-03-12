<?php namespace Fisharebest\Localization;

/**
 * Class LocaleSrCyrlXk
 *
 * @author        Greg Roach <fisharebest@gmail.com>
 * @copyright (c) 2015 Greg Roach
 * @license       GPLv3+
 */
class LocaleSrCyrlXk extends LocaleSrCyrl {
	/** {@inheritdoc} */
	public function territory() {
		return new TerritoryXk;
	}
}