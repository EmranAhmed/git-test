/**
 * External dependencies
 */
import { useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @param {Object}   props               Properties passed to the function.
 * @param {Object}   props.attributes    Available block attributes.
 *
 * @return {Element} Element to render.
 */
export default function save( { attributes } ) {
	const { x } = attributes;
	const blockProps = useBlockProps.save( {
		style: {
			'--css-variable': `100%`,
		},
	} );
	const innerBlockProps = useInnerBlocksProps.save();

	return (
		<div { ...blockProps }>
			<h1>
				{ __( 'Test Plugin – static block save.js!', 'test-plugin' ) }
			</h1>
			<div { ...innerBlockProps } />
		</div>
	);
}
