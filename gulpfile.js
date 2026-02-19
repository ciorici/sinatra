const { src, dest, watch, series, parallel } = require( 'gulp' );
const sass = require( 'gulp-sass' )( require( 'sass' ) );
const postcss = require( 'gulp-postcss' );
const autoprefixer = require( 'autoprefixer' );
const cleanCSS = require( 'gulp-clean-css' );
const terser = require( 'gulp-terser' );
const rename = require( 'gulp-rename' );
const fs = require( 'fs' );
const path = require( 'path' );

// ─── Paths ────────────────────────────────────────────────────────────

const paths = {
	// Pipeline 1: Customizer control SCSS → CSS → min.CSS
	controlScss: 'inc/customizer/controls/*/*.scss',

	// Pipeline 2: Plain CSS → autoprefixed min.CSS
	css: [
		'assets/css/style.css',
		'assets/css/editor-style.css',
		'assets/css/woocommerce.css',
		'assets/css/compatibility/woocommerce.css',
		'assets/css/compatibility/elementor.css',
		'assets/css/compatibility/elementor-editor-style.css',
		'inc/admin/assets/css/sinatra-admin.css',
		'inc/admin/assets/css/sinatra-meta-boxes.css',
		'inc/admin/assets/css/sinatra-block-editor-styles.css',
		'inc/customizer/assets/css/sinatra-customizer.css',
		'inc/customizer/assets/css/sinatra-customizer-preview.css',
	],

	// Pipeline 3: Frontend JS (dev/ → parent directory)
	frontJs: [
		'assets/js/dev/sinatra.js',
		'assets/js/dev/sinatra-slider.js',
		'assets/js/dev/sinatra-wc.js',
		'assets/js/dev/skip-link-focus-fix.js',
	],

	// Pipeline 4: Admin/Customizer JS (dev/ → parent .min.js only)
	adminJs: 'inc/admin/assets/js/dev/sinatra-admin.js',
	customizerJs: 'inc/customizer/assets/js/dev/*.js',

	// Pipeline 5: Customizer control JS (in-place minify)
	controlJs: [
		'inc/customizer/controls/*/*.js',
		'!inc/customizer/controls/*/*.min.js',
	],
};

// ─── Pipeline 1: Customizer Control SCSS ──────────────────────────────

function controlScss() {
	return src( paths.controlScss, { base: '.' } )
		.pipe( sass().on( 'error', sass.logError ) )
		.pipe( postcss( [ autoprefixer() ] ) )
		.pipe( dest( '.' ) )
		.pipe( cleanCSS() )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( dest( '.' ) );
}

// ─── Pipeline 2: Plain CSS → Autoprefixed min.CSS ─────────────────────

function css() {
	return src( paths.css, { base: '.' } )
		.pipe( postcss( [ autoprefixer() ] ) )
		.pipe( cleanCSS() )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( dest( '.' ) );
}

// ─── Pipeline 3: Frontend JS (dev/ → parent copy + min) ──────────────

function frontJsCopy() {
	return src( paths.frontJs )
		.pipe( dest( 'assets/js/' ) );
}

function frontJsMin() {
	return src( paths.frontJs )
		.pipe( terser() )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( dest( 'assets/js/' ) );
}

const frontJs = parallel( frontJsCopy, frontJsMin );

// ─── Pipeline 4: Admin/Customizer JS (dev/ → parent min) ─────────────

function adminJsMin() {
	return src( paths.adminJs )
		.pipe( terser() )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( dest( 'inc/admin/assets/js/' ) );
}

function customizerJsMin() {
	return src( paths.customizerJs )
		.pipe( terser() )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( dest( 'inc/customizer/assets/js/' ) );
}

// ─── Pipeline 5: Customizer Control JS (in-place minify) ─────────────

function controlJs() {
	return src( paths.controlJs, { base: '.' } )
		.pipe( terser() )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( dest( '.' ) );
}

// ─── Aggregate tasks ──────────────────────────────────────────────────

const buildCss = parallel( controlScss, css );
const buildJs = parallel( frontJs, adminJsMin, customizerJsMin, controlJs );
const build = parallel( buildCss, buildJs );

// ─── Watch ────────────────────────────────────────────────────────────

function watchFiles() {
	watch( 'inc/customizer/controls/*/*.scss', controlScss );
	watch( paths.css, css );
	watch( paths.frontJs, frontJs );
	watch( paths.adminJs, adminJsMin );
	watch( paths.customizerJs, customizerJsMin );
	watch( paths.controlJs, controlJs );
}

// ─── Version bump ────────────────────────────────────────────────────
// Usage: gulp version-bump --ver=1.5.0

function versionBump( cb ) {
	const arg = process.argv;
	const verFlag = arg.find( ( a ) => a.startsWith( '--ver=' ) );

	if ( ! verFlag ) {
		console.error( 'Usage: gulp version-bump --ver=x.y.z' );
		return cb( new Error( 'Missing --ver argument' ) );
	}

	const newVer = verFlag.split( '=' )[ 1 ];

	if ( ! /^\d+\.\d+\.\d+$/.test( newVer ) ) {
		return cb( new Error( 'Version must be in semver format: x.y.z' ) );
	}

	// 1. package.json
	const pkgPath = path.resolve( 'package.json' );
	const pkg = JSON.parse( fs.readFileSync( pkgPath, 'utf8' ) );
	pkg.version = newVer;
	fs.writeFileSync( pkgPath, JSON.stringify( pkg, null, '  ' ) + '\n' );

	// 2. style.css — "Version: x.y.z"
	replaceInFile(
		'style.css',
		/^Version:\s*.+$/m,
		'Version: ' + newVer
	);

	// 3. functions.php — "$version = 'x.y.z'"
	replaceInFile(
		'functions.php',
		/\$version\s*=\s*'[^']*'/,
		"$version = '" + newVer + "'"
	);

	// 4. readme.txt — "Stable tag: x.y.z"
	replaceInFile(
		'readme.txt',
		/^Stable tag:\s*.+$/m,
		'Stable tag: ' + newVer
	);

	console.log( 'Version bumped to ' + newVer );
	cb();
}

function replaceInFile( filePath, search, replacement ) {
	let content = fs.readFileSync( filePath, 'utf8' );
	content = content.replace( search, replacement );
	fs.writeFileSync( filePath, content );
}

// ─── Generate README.md from readme.txt ──────────────────────────────

function readme( cb ) {
	let txt = fs.readFileSync( 'readme.txt', 'utf8' );

	// Convert WordPress readme headings to Markdown.
	// === Title === → # Title #
	txt = txt.replace( /^=== (.+?) ===\s*$/gm, '# $1 #' );
	// == Section == → ## Section ##
	txt = txt.replace( /^== (.+?) ==\s*$/gm, '## $1 ##' );
	// = Subsection = → ### Subsection ###
	txt = txt.replace( /^= (.+?) =\s*$/gm, '### $1 ###' );

	// Convert "Contributors: a, b" to linked format.
	txt = txt.replace(
		/^(Contributors:\s*)(.+)$/m,
		function ( _match, prefix, names ) {
			const linked = names.split( ',' ).map( ( n ) => {
				n = n.trim();
				return '[' + n + '](https://github.com/' + n + ')';
			} ).join( ', ' );
			return '**' + prefix.trim() + '** ' + linked + '  ';
		}
	);

	// Format metadata as "**Key:** value  " (bold key, trailing double-space for line break).
	const metaKeys = [
		'Tags',
		'Requires at least',
		'Tested up to',
		'Requires PHP',
		'License',
		'License URI',
	];
	metaKeys.forEach( function ( key ) {
		const re = new RegExp( '^' + key + ':\\s*(.+)$', 'm' );
		txt = txt.replace( re, '**' + key + ':** $1  ' );
	} );

	// Convert "Stable tag" to "Version" for GitHub display.
	txt = txt.replace( /^Stable tag:\s*(.+)$/m, '**Version:** $1  ' );

	// WordPress » → &raquo; (already works in GH markdown).
	txt = txt.replace( / » /g, ' &raquo; ' );

	// Rename "Resources" to "Copyright" and add license preamble.
	txt = txt.replace(
		'## Resources ##',
		'## Copyright ##\n\n' +
		'Sinatra WordPress Theme, Copyright 2025 ciorici\n' +
		'Originally created by Sinatra Team (https://sinatrawp.com).\n' +
		'Sinatra is distributed under the terms of the GNU GPL.\n\n' +
		'Sinatra bundles the following third-party resources:'
	);

	// Custom header — matches the Inspiro pattern.
	const customHeader =
		'# Sinatra #\n' +
		'### A lightweight and highly customizable multi-purpose theme that makes it easy for anyone to create their perfect website.\n\n' +
		'Community-maintained fork of the original Sinatra theme by [Sinatra Team](https://sinatrawp.com). ' +
		'Includes security fixes, PHP 8.2+ compatibility, WordPress 6.9+ support, and updated WooCommerce templates.\n\n' +
		'[Download Latest Release](https://github.com/ciorici/sinatra/releases) ' +
		'&nbsp;&middot;&nbsp; ' +
		'[View on WordPress.org](https://wordpress.org/themes/flavor/)\n\n' +
		'![Sinatra Theme Screenshot](screenshot.jpg)\n\n';

	// Replace everything before "**Contributors:" with custom header.
	const contribIndex = txt.indexOf( '**Contributors:' );
	if ( contribIndex !== -1 ) {
		txt = customHeader + txt.substring( contribIndex );
	}

	fs.writeFileSync( 'README.md', txt );
	console.log( 'README.md generated from readme.txt' );
	cb();
}

// ─── Theme rename ────────────────────────────────────────────────────
// Usage: gulp rename --name=Flavor [--prefix=flv]
//
// One-time task that renames the theme (and sinatra-core plugin) from
// "Sinatra" to the given name.  Review the result with `git diff`.

function themeRename( cb ) {
	const args = process.argv;
	const nameFlag = args.find( ( a ) => a.startsWith( '--name=' ) );
	const prefixFlag = args.find( ( a ) => a.startsWith( '--prefix=' ) );

	if ( ! nameFlag ) {
		console.error( 'Usage: gulp rename --name=Flavor [--prefix=flv]' );
		return cb( new Error( 'Missing --name argument' ) );
	}

	const Name = nameFlag.split( '=' )[ 1 ]; // Title Case
	const name = Name.toLowerCase(); // lowercase slug
	const NAME = Name.toUpperCase(); // UPPER_CASE
	const prefix = prefixFlag
		? prefixFlag.split( '=' )[ 1 ]
		: name.substring( 0, 2 ); // default: first 2 chars

	if ( ! /^[A-Z][a-zA-Z]+$/.test( Name ) ) {
		return cb( new Error( 'Name must be TitleCase, letters only (e.g. Flavor)' ) );
	}

	// Verify the theme hasn't already been renamed.
	const styleCss = fs.readFileSync( 'style.css', 'utf8' );
	if ( ! /Theme Name:\s*Sinatra/.test( styleCss ) ) {
		return cb( new Error( 'Theme already renamed. This task can only run once.' ) );
	}

	console.log( 'Renaming: Sinatra → ' + Name );
	console.log( '  slug:       sinatra → ' + name );
	console.log( '  CSS prefix: si- → ' + prefix + '-' );
	console.log( '' );

	const themeDir = path.resolve( '.' );
	const pluginDir = path.resolve( themeDir, '..', '..', '..', 'plugins', 'sinatra-core' );
	const extensions = [
		'.php', '.css', '.scss', '.js', '.json', '.xml',
		'.txt', '.md', '.pot', '.svg',
	];
	const excludedDirs = [ 'node_modules', '.git', 'vendor' ];

	// ── Text replacements (most specific → least specific) ──

	const replacements = [
		// PHP constants (UPPER_CASE).
		[ /\bSINATRA_CORE_/g, NAME + '_CORE_' ],
		[ /\bSINATRA_THEME_/g, NAME + '_THEME_' ],
		[ /\bSINATRA_/g, NAME + '_' ],

		// PHP class names (Title_Case).
		[ /\bSinatra_Core_/g, Name + '_Core_' ],
		[ /\bSinatra_/g, Name + '_' ],

		// PHP function/hook names (snake_case).
		[ /\bsinatra_core_/g, name + '_core_' ],
		[ /\bsinatra_core\b/g, name + '_core' ],
		[ /\bsinatra_/g, name + '_' ],

		// JS camelCase identifiers.
		[ /\bsinatraCoreDemoLibrary\b/g, name + 'CoreDemoLibrary' ],
		[ /\bsinatra([A-Z])/g, name + '$1' ],
		[ /window\.sinatra\b/g, 'window.' + name ],
		[ /\bsinatra\(\)/g, name + '()' ],

		// Hyphenated identifiers (CSS classes, text domains, file refs).
		[ /sinatra-core/g, name + '-core' ],
		[ /sinatra-/g, name + '-' ],

		// Short CSS prefix.
		[ /\bsi-/g, prefix + '-' ],

		// Remaining display text (catches comments, descriptions, etc.).
		[ /Sinatra/g, Name ],
		[ /sinatra/g, name ],
		[ /SINATRA/g, NAME ],
	];

	// ── Helper: walk directory tree ──

	function walkDir( dir ) {
		const results = [];
		const entries = fs.readdirSync( dir, { withFileTypes: true } );
		for ( const entry of entries ) {
			if ( excludedDirs.includes( entry.name ) ) {
				continue;
			}
			const full = path.join( dir, entry.name );
			if ( entry.isDirectory() ) {
				results.push( ...walkDir( full ) );
			} else if ( extensions.some( ( ext ) => entry.name.endsWith( ext ) ) ) {
				results.push( full );
			}
		}
		return results;
	}

	// ── 1. Replace file contents ──

	function replaceContents( dir ) {
		let count = 0;
		const files = walkDir( dir );
		for ( const filePath of files ) {
			let content = fs.readFileSync( filePath, 'utf8' );
			const original = content;
			for ( const [ search, replacement ] of replacements ) {
				content = content.replace( search, replacement );
			}
			if ( content !== original ) {
				fs.writeFileSync( filePath, content );
				count++;
			}
		}
		return count;
	}

	let changed = replaceContents( themeDir );
	console.log( 'Theme: ' + changed + ' files updated.' );

	if ( fs.existsSync( pluginDir ) ) {
		changed = replaceContents( pluginDir );
		console.log( 'Plugin: ' + changed + ' files updated.' );
	}

	// ── 2. Rename files and directories ──

	function collectRenames( dir ) {
		const results = [];
		const entries = fs.readdirSync( dir, { withFileTypes: true } );
		for ( const entry of entries ) {
			if ( excludedDirs.includes( entry.name ) ) {
				continue;
			}
			const full = path.join( dir, entry.name );
			if ( entry.isDirectory() ) {
				results.push( ...collectRenames( full ) );
			}
			if ( entry.name.includes( 'sinatra' ) ) {
				results.push( {
					fullPath: full,
					dir: dir,
					name: entry.name,
					isDir: entry.isDirectory(),
				} );
			}
		}
		return results;
	}

	function renameEntries( dir ) {
		const entries = collectRenames( dir );
		let count = 0;

		// Files first.
		entries
			.filter( ( e ) => ! e.isDir )
			.forEach( ( e ) => {
				const newName = e.name.replace( /sinatra/g, name );
				fs.renameSync( e.fullPath, path.join( e.dir, newName ) );
				count++;
			} );

		// Directories deepest-first.
		entries
			.filter( ( e ) => e.isDir )
			.sort( ( a, b ) => b.fullPath.length - a.fullPath.length )
			.forEach( ( e ) => {
				const newName = e.name.replace( /sinatra/g, name );
				const newPath = path.join( path.dirname( e.fullPath ), newName );
				if ( ! fs.existsSync( newPath ) ) {
					fs.renameSync( e.fullPath, newPath );
					count++;
				}
			} );

		return count;
	}

	let renamed = renameEntries( themeDir );
	console.log( 'Theme: ' + renamed + ' files/dirs renamed.' );

	let currentPluginDir = pluginDir;
	if ( fs.existsSync( pluginDir ) ) {
		renamed = renameEntries( pluginDir );

		// Rename the plugin directory itself.
		const newPluginDir = path.resolve( pluginDir, '..', name + '-core' );
		if ( ! fs.existsSync( newPluginDir ) ) {
			fs.renameSync( pluginDir, newPluginDir );
			currentPluginDir = newPluginDir;
			renamed++;
		}
		console.log( 'Plugin: ' + renamed + ' files/dirs renamed.' );
	}

	// ── 3. Post-rename fixups ──

	// Restore migration class backwards-compat constants.
	const migrationFile = path.join(
		themeDir, 'inc', 'core', 'class-' + name + '-migration.php'
	);
	if ( fs.existsSync( migrationFile ) ) {
		let mc = fs.readFileSync( migrationFile, 'utf8' );
		mc = mc.replace(
			"const OLD_SLUG = '" + name + "'",
			"const OLD_SLUG = 'sinatra'"
		);
		mc = mc.replace(
			"const OLD_PREFIX = '" + name + "_'",
			"const OLD_PREFIX = 'sinatra_'"
		);
		fs.writeFileSync( migrationFile, mc );
		console.log( 'Fixed: migration class OLD_SLUG/OLD_PREFIX restored.' );
	}

	// Add backwards-compat theme check in plugin bootstrap.
	const pluginBootstrap = path.join( currentPluginDir, name + '-core.php' );
	if ( fs.existsSync( pluginBootstrap ) ) {
		let pc = fs.readFileSync( pluginBootstrap, 'utf8' );
		const newCheck =
			"'" + Name + "' === $theme->name || '" + name + "' === $theme->template";
		const compatCheck = newCheck +
			" ||\n\t     'Sinatra' === $theme->name || 'sinatra' === $theme->template";
		if ( pc.includes( newCheck ) && ! pc.includes( "'Sinatra'" ) ) {
			pc = pc.replace( newCheck, compatCheck );
			fs.writeFileSync( pluginBootstrap, pc );
			console.log( 'Fixed: plugin theme check — added Sinatra backwards compat.' );
		}
	}

	console.log( '\nDone! Review changes with: git diff' );
	cb();
}

// ─── Exports ──────────────────────────────────────────────────────────

exports.build = build;
exports.watch = series( build, watchFiles );
exports.readme = readme;
exports[ 'version-bump' ] = series( versionBump, readme );
exports.rename = themeRename;
exports.default = build;
