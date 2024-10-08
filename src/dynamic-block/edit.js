/**
 * External dependencies
 */
import { __ } from '@wordpress/i18n';
import { useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @param {Object}   props               Properties passed to the function.
 * @param {Object}   props.attributes    Available block attributes.
 * @param {Function} props.setAttributes Function that updates individual attributes.
 * @param {string}   props.clientId      Block editor client id.
 *
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes, clientId } ) {
	const blockProps = useBlockProps();
	const innerBlockProps = useInnerBlocksProps();

	return (
		<div { ...blockProps }>
			<h1>
				{ __( 'Test Plugin – dynamic block edit.js!', 'test-plugin' ) }
			</h1>
			<div { ...innerBlockProps } />
		</div>
	);
}
