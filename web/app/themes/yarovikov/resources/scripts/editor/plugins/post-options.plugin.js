import {PluginDocumentSettingPanel} from '@wordpress/editor';
import {ToggleControl} from '@wordpress/components';
import {useSelect, useDispatch} from '@wordpress/data';
import {useEffect, useState} from '@wordpress/element';
import {cog} from '@wordpress/icons';

export const name = 'post-options-panel';
export const title = 'Post Options';

export const render = () => {
  const postType = useSelect((select) =>
    select('core/editor').getCurrentPostType()
  );

  if ('post' !== postType) {
    return null;
  }

  const meta = useSelect((select) =>
    select('core/editor').getEditedPostAttribute('meta')
  );

  const {editPost} = useDispatch('core/editor');
  const [isSidebar, setIsSidebar] = useState(false);

  useEffect(() => {
    if (meta) {
      setIsSidebar(meta.is_featured || false);
    }
  }, [meta]);

  return (
    <PluginDocumentSettingPanel
      name='post-options-panel'
      title='Post Options'
      icon={cog}
    >
      <ToggleControl
        label='Make as featured?'
        checked={isSidebar}
        onChange={(value) => {
          setIsSidebar(value);
          editPost({meta: {is_featured: value}})
        }}
      />
    </PluginDocumentSettingPanel>
  );
};
