import {
	InspectorControls,
	RichText,
	useBlockProps
} from '@wordpress/block-editor';
import { registerBlockType } from '@wordpress/blocks';
import { PanelBody, ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import icons from '../../icons.js';
import './main.css';

registerBlockType('udemy-plus/page-header', {
	icon: icons.primary,
	edit({ attributes, setAttributes }) {
		const { content, showCategory } = attributes;
		const blockProps = useBlockProps();

		return (
			<>
				<InspectorControls>
					<PanelBody title={__('General', 'up')}>
						<ToggleControl
							label={__('Show Category', 'up')}
							checked={showCategory}
							onChange={showCategory => setAttributes({ showCategory })}
							help={
								showCategory ?
									__('Category shown', 'up')
									:
									__('Custom content shown', 'up')
							}
						/>
					</PanelBody>
				</InspectorControls>
				<div {...blockProps}>
					<div className="inner-page-header">
						{
							showCategory ?
								(<h1>{__('Category: Some Category', 'up')}</h1>)
								:
								(<RichText
									tagName="h1"
									placeholder={__('Heading', 'up')}
									value={content}
									onChange={content => setAttributes({ content })}
								/>)
						}

					</div>
				</div>
			</>
		);
	}
});