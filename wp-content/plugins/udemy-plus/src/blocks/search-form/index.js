import { InspectorControls, useBlockProps, PanelColorSettings, } from "@wordpress/block-editor";
import { registerBlockType } from '@wordpress/blocks';
import { ColorPalette, PanelBody } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import icons from '../../icons';
import block from './block.json';
import './main.css';

registerBlockType(block.name, {
	icon: icons.primary,
	edit({ attributes, setAttributes }) {
		const { textColor, bgColor } = attributes;
		const blockProps = useBlockProps({
			style: {
				'background-color': bgColor,
				'color': textColor
			}
		});


		return (
			<>
				<InspectorControls>
					<PanelColorSettings
						title={__('Colore', 'up')}
						colorSettings={
							[
								{
									label: __('Sfondo', 'up'),
									value: bgColor,
									onChange: (newVal) => setAttributes({ bgColor: newVal }),
								},
								{
									label: __('Testo', 'up'),
									value: textColor,
									onChange: (newVal) => setAttributes({ textColor: newVal }),
								}
							]
						}
					/>
				</InspectorControls>
				<div {...blockProps}>
					<h1>Search: Your search term here</h1>
					<form>
						<input type="text" placeholder="Search" />
						<div className="btn-wrapper">
							<button
								type="submit"
								style={{
									"background-color": bgColor,
									"color": textColor,
								}}
							>Search</button>
						</div>
					</form>
				</div>
			</>
		)
	}
})