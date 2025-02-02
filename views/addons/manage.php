<?php
/**
 * SlideDeck Administrative Options
 * 
 * More information on this project:
 * http://www.slidedeck.com/
 * 
 * Full Usage Documentation: http://www.slidedeck.com/usage-documentation 
 * 
 * @package SlideDeck
 * @subpackage SlideDeck 3 Pro for WordPress
 * @author Hummingbird Web Solutions Pvt. Ltd.
 */
/*
  Copyright 2012 HBWSL  (email : support@hbwsl.com)

  This file is part of SlideDeck.

  SlideDeck is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  SlideDeck is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with SlideDeck.  If not, see <http://www.gnu.org/licenses/>.
 */
?>
<div class="wrap" id="slidedeck_lens_management">

    <div class="slidedeck-header">
        <h1>SlideDeck Addons</h1>
        <a class="button" href="<?php echo slidedeck2_action( '/addons&action=add' ); ?>">Upload Addon</a>
    </div>

    <div id="slidedeck-lenses-wrapper">

		<?php // if ( !empty( $addons ) ): ?>

			<div id="slidedeck-addons" class="lenses clearfix">

				<?php foreach ( $addons as &$addon ): ?>

					<?php include( SLIDEDECK2_DIRNAME . '/views/elements/_addons.php' ); ?>

				<?php endforeach; ?>
                                <?php do_action( "{$this->namespace}_manage_addons_after_addons", $addons ); ?>
			</div>

		<?php // endif; ?>

    </div>

</div>
