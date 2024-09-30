import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { registerBlockType } from '@wordpress/blocks';
import { PanelBody, ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import icons from '../../icons.js';
import './main.css';

registerBlockType('udemy-plus/auth-modal', {
	icon: {
		src: icons.primary
	},
	edit({ attributes, setAttributes }) {
		const { showRegister } = attributes;
		const blockProps = useBlockProps();

		return (
			<>
				<InspectorControls>
					<PanelBody title={__('General', 'up')}>
						<ToggleControl
							label={__('Show Register', 'up')}
							help={
								showRegister ? __('Show registration form', 'up') : __('Hiding registration form', 'up')
							}
							checked={showRegister}
							onChange={showRegister => setAttributes({ showRegister })}
						/>
					</PanelBody>
				</InspectorControls>
				<div {...blockProps}>
					{__('This block is not previewable from the editor. View your site for a live demo.', 'up')}
				</div>
			</>
		);
	}
});