import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';

export default function Save({ attributes })
{
	//
	return (
		<div
			{...useBlockProps.save()}
			data-wp-interactive="navigator__store"
			data-wp-context={JSON.stringify(attributes)}
			>
			<div data-wp-on--click="actions.onClick">
				<InnerBlocks.Content />
			</div>
		</div>
	)
}
