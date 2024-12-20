import {PluginDocumentSettingPanel} from '@wordpress/editor';
import {ToggleControl} from '@wordpress/components';
import {useSelect, useDispatch} from '@wordpress/data';
import {useEffect, useState} from '@wordpress/element';
import {cog} from '@wordpress/icons';

export const name = 'page-options-panel';
export const title = 'Page Options';

export const render = () => {
  const postType = useSelect((select) =>
    select('core/editor').getCurrentPostType()
  );

  if ('page' !== postType) {
    return null;
  }

  const meta = useSelect((select) =>
    select('core/editor').getEditedPostAttribute('meta')
  );

  const {editPost} = useDispatch('core/editor');
  const [isSidebar, setIsSidebar] = useState(false);

  useEffect(() => {
    if (meta) {
      setIsSidebar(meta.is_sidebar || false);
    }
  }, [meta]);

  return (
    <PluginDocumentSettingPanel
      name='page-options-panel'
      title='Page Options'
      icon={cog}
    >
      <ToggleControl
        label='Show sidebar?'
        checked={isSidebar}
        onChange={(value) => {
          setIsSidebar(value);
          editPost({meta: {is_sidebar: value}})
        }}
      />
    </PluginDocumentSettingPanel>
  );
};
