import { registerBlockType } from '@wordpress/blocks';
import icons from '../../icons.js';
import edit from './edit';
import './main.css';
import save from './save.js';

registerBlockType('udemy-plus/team-member', {
	icon: {
		src: icons.primary
	},
	edit,
	save
});