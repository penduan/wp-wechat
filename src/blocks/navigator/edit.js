
import { useBlockProps, InnerBlocks, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, RadioControl } from '@wordpress/components';

export default function Edit({ attributes, setAttributes })
{
		return (
			<>
				<InspectorControls>
						<PanelBody title="Navigator Settings">
								<RadioControl
									label="type"
									selected={attributes.type}
									options={[
										{ label: 'navigateTo', value: 'navigateTo' },
										{ label: 'redirectTo', value: 'redirectTo' },
										{ label: 'switchTab', value: 'switchTab' },
										{ label: 'reLaunch', value: 'reLaunch' },
										{ label: 'navigateBack', value: 'navigateBack' },
									]}
									onChange={(type) => setAttributes({ type })}
								/>
								<TextControl
									label="URL"
									value={attributes.url}
									onChange={(url) => setAttributes({ url })}
								/>
						</PanelBody>
				</InspectorControls>
				<div {...useBlockProps()}>
						<div className="wp-block-wechat-navigator--header">
								<h4>{attributes.type} - {attributes.url}</h4>
						</div>
						<InnerBlocks />
				</div>
			</>
		);
}
