<?php namespace cms\Modules\Themes\Domain\Themes\Themes\Repositories;

use Theme;
use cms\Infrastructure\Abstractions\Requests\FormRequestAbstract;
use cms\Modules\Themes\Domain\Themes\Settings\Repositories\SettingsRepository;

/**
 * Class ThemesRepository
 * @package cms\Modules\Themes\Domain\Themes\Themes\Repositories
 */
class ThemesRepository
{

    /**
     * @var SettingsRepository|null
     */
    protected $r_settings = null;

	/**
	 * ThemesRepository constructor.
	 *
	 * @param SettingsRepository $r_settings
	 */
    public function __construct(SettingsRepository $r_settings)
    {
        $this->r_settings = $r_settings;
    }

    /**
     * Get active themes
     *
     * @return mixed
     */
    public function all()
    {
        $themes = [
            'backend' => [],
            'frontend' => []
        ];

        foreach (Theme::all() as $theme) {

            $theme_config = $this->get_active_themes($theme);

            if (file_exists($theme_config)) {
                // Read theme configuration
                $theme_config = json_decode(file_get_contents($theme_config));
                // Order themes
                $themes[$theme_config->type][$theme->name] = [
                    'name' => $theme->name,
                    'preview' => !empty($theme_config->preview) ? $theme_config->preview : '',
                    'preview_path' => 'themes/' . $theme->name . '/img/',
                    'path' => $theme->getPath(),
                    'active' => $this->r_settings->get('themes.themes.' . $theme_config->type) === $theme->name
                ];
            }
        }
        return $themes;
    }

    /**
     * Allow to change frontend or backend theme
     *
     * @param string $id Theme name
     * @param string $type backend|frontend
     */
    public function update($id, $type)
    {
        if (!in_array($type, array_keys($this->r_settings->get('themes.themes')))) {
            abort(404);
        }
        $this->r_settings->set('themes.themes.' . $type, $id);
    }

    /**
     * Get theme configuration file path
     *
     * @param $theme
     * @return string
     */
    private function get_active_themes($theme)
    {
        return $theme->getPath() . '/' . config('themes.config');
    }

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function indexSettingsBackEnd()
	{
		return cmsview(
			'themes.backend.index',
			[
				'themes' => $this->all()
			],
			'themes::'
		);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param                     $id
	 * @param FormRequestAbstract $request
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function updateSettingsBackEnd($id, FormRequestAbstract $request)
	{
		$type = $request->get('type');
		$this->update($id, $type);
		return redirect(route('backend.themes.index'));
	}

}
