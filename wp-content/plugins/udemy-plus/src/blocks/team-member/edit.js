import { isBlobURL, revokeBlobURL } from '@wordpress/blob';
import {
	BlockControls,
	InspectorControls,
	MediaPlaceholder,
	MediaReplaceFlow,
	RichText,
	useBlockProps
} from '@wordpress/block-editor';
import {
	PanelBody,
	Spinner,
	TextareaControl,
	ToolbarButton
} from '@wordpress/components';
import { useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

export default function ({ attributes, setAttributes, context }) {
	const {
		name, title, bio, imgID, imgAlt, imgURL, socialHandles
	} = attributes;
	const blockProps = useBlockProps();
	const [imgPreview, setImgPreview] = useState(imgURL);

	const selectImg = (img) => {
		let newImgURL = null;
		if (isBlobURL(img.url)) {
			newImgURL = img.url;
		} else {
			newImgURL = img.sizes ? img.sizes.teamMember.url : img.media_details.sizes.teamMember.source_url;

			setAttributes({
				imgID: img.id,
				imgAlt: img.alt,
				imgURL: newImgURL
			});

			revokeBlobURL(imgPreview);
		}
		setImgPreview(newImgURL);
	}

	const selectImgURL = (url) => {
		setAttributes({
			imgID: null,
			imgAlt: null,
			imgURL: url
		})


		setImgPreview(url);
	}

	const imageClass = `wp-image-${imgID} img-${context['udemy-plus/image-shape']}`;

	return (
		<>
			{
				imgPreview &&
				<BlockControls group="inline">
					<MediaReplaceFlow
						name={__('Replace Image', 'up')}
						mediaId={imgID}
						mediaURL={imgURL}
						allowedTypes={['image']}
						accept={'image/*'}
						onError={err => console.error(err)}
						onSelect={selectImg}
						onSelectURL={selectImgURL}
					/>
					<ToolbarButton
						onClick={() => {
							setAttributes({
								imgID: null,
								imgAlt: '',
								imgURL: ''
							});
							setImgPreview('');
						}}
					>
						{__('Remove Image', 'up')}
					</ToolbarButton>
				</BlockControls>
			}

			<InspectorControls>
				<PanelBody title={__('Settings', 'udemy-plus')}>
					{
						imgPreview && <TextareaControl
							label={__('Alt Attribute', 'udemy-plus')}
							value={imgAlt}
							onChange={imgAlt => setAttributes({ imgAlt })}
							help={__(
								'Description of your image for screen readers.',
								'udemy-plus'
							)}
						/>
					}

				</PanelBody>
			</InspectorControls>
			<div {...blockProps}>
				<div className="author-meta">
					{
						imgPreview && <img src={imgPreview} alt={imgAlt} className={imageClass} />
					}
					{
						isBlobURL(imgPreview) && <Spinner />
					}

					<MediaPlaceholder
						allowedTypes={['image']}
						accept={'image/*'}
						icon="admin-users"
						onSelect={selectImg}
						onError={err => console.error(err)}
						disableMediaButtons={imgPreview}
						onSelectURL={selectImgURL}
					/>
					<p>
						<RichText
							placeholder={__('Name', 'udemy-plus')}
							tagName="strong"
							onChange={name => setAttributes({ name })}
							value={name}
						/>
						<RichText
							placeholder={__('Title', 'udemy-plus')}
							tagName="span"
							onChange={title => setAttributes({ title })}
							value={title}
						/>
					</p>
				</div>
				<div className="member-bio">
					<RichText
						placeholder={__('Member bio', 'udemy-plus')}
						tagName="p"
						onChange={bio => setAttributes({ bio })}
						value={bio}
					/>
				</div>
				<div className="social-links"></div>
			</div>
		</>
	);
}