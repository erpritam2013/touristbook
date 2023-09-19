import resolve      from 'rollup-plugin-node-resolve'
import babel        from 'rollup-plugin-babel'
import filesize     from 'rollup-plugin-filesize'
import typescript   from 'rollup-plugin-typescript2'
import commonjs     from 'rollup-plugin-commonjs'
import postcss      from 'rollup-plugin-postcss-modules'
import autoprefixer from 'autoprefixer'
import sass         from "node-sass"

const preprocessor = (content, id) => new Promise((resolve, reject) => {
    sass.render({
        file: id,
        sourceMap: "string",
        sourceComments: true,
        sourceMapContents: true,
        outputStyle: "compressed"
    },(err, result) => {
        if (err) {
            return reject(err);
        }
        resolve({code: result.css.toString()});
    });
});

export default {
    input: 'src/index.ts',
    output: {
        file: 'lib/index.js',
        format: 'umd',
        globals: {
            ...
        },
        sourcemap: true,
    },
    external: [
        ...
    ],
    plugins: [ 
        resolve(),  
        postcss({
            preprocessor,
            plugins: [
                autoprefixer(),
            ],
            extensions: ['.scss'],
            writeDefinitions: true,
            postcssModulesOptions: {
                generateScopedName: '[name]__[local]___[hash:base64:5]'
            }
        }),
        typescript({
            tsconfigOverride: {
                compilerOptions: {
                    declaration: true,
                    moduleResolution: "node"
                }
            },
            rollupCommonJSResolveHack: true,
            abortOnError: false,
            typescript: require('typescript'),
        }),
        commonjs(),   
        babel({
            exclude: 'node_modules/**'
        }),
        filesize()
    ],
    watch: {
        include: 'src/**'
    }
  };