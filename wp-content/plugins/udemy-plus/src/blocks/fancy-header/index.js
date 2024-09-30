import { InspectorControls, RichText, useBlockProps } from "@wordpress/block-editor";
import { registerBlockType } from '@wordpress/blocks';
import { ColorPalette, PanelBody } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import block from './block.json';
import './main.css';

registerBlockType(block.name, {
	title: __('RichText block'),
	edit({ attributes, setAttributes }) {
		const { content, underline_color } = attributes;
		const blockProps = useBlockProps();
		return (
			<>
				<InspectorControls>
					<PanelBody title={__('Colors', 'up')}>
						<ColorPalette colors={[
							{ name: "Red", color: "#f87171" },
							{ name: "Indigo", color: "#818cf8" }
						]}
							value={underline_color}
							onChange={newVal => setAttributes({ underline_color: newVal })}
						/>
					</PanelBody>
				</InspectorControls>
				<div {...blockProps}>
					<RichText
						className="fancy-header"
						tagName="h2"
						placeholder={__("Enter heading", "up")}
						value={content}
						onChange={newVal => setAttributes({ content: newVal })}
						allowedFormats={['core/bold', 'core/italic']}
					/>
				</div>
			</>
		)
	},
	save({ attributes }) {
		const { content, underline_color } = attributes;
		const blockProps = useBlockProps.save({
			className: 'fancy-header',
			style: {
				'background-image': `
					linear-gradient(transparent, transparent),
					linear-gradient(${underline_color}, ${underline_color});
				`
			}
		});
		return (
			<div {...blockProps}>
				<RichText.Content
					tagName="h2"
					value={content}
				/>
			</div>
		);
	}
});