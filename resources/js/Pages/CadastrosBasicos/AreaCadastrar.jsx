import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';

export default function AreaCadastrar({ auth, flash, blocos }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        nome: '',
        bloco_id: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('area.store'), {
            onSuccess: () => {
                reset();
            },
        });
    };
    console.log(blocos);
    console.log("Nada");
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Áreas</h2>}
        >
            <Head title="Cadastro de Áreas" />

            <form onSubmit={submit} className="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
                <InputLabel htmlFor="nome" value="Nome da Área" />
                <TextInput
                    id="nome"
                    name="nome"
                    value={data.nome}
                    className="mt-1 block w-full"
                    autoComplete="nome"
                    isFocused={true}
                    onChange={(e) => setData('nome', e.target.value)}
                    required
                />

                <InputLabel htmlFor="bloco_id" value="Bloco" />
                <select
                    id="bloco_id"
                    name="bloco_id"
                    value={data.bloco_id}
                    className="mt-1 block w-full"
                    onChange={(e) => setData('bloco_id', e.target.value)}
                    required
                >
                    <option value="">Selecione um bloco</option>
                    {/* {blocos.map((bloco) => (
                        <option key={bloco.id} value={bloco.id}>
                            {bloco.nome}
                        </option>
                    ))} */}
                </select>

                {flash.success && (
                    <div className="my-4 text-sm font-medium text-green-600">
                        {flash.success}
                    </div>
                )}

                <PrimaryButton className="ms-4 my-2" disabled={processing}>
                    Cadastrar
                </PrimaryButton>

                <a
                    className="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-4 my-2"
                    href={route('area.index')}
                >
                    Voltar
                </a>
            </form>
        </AuthenticatedLayout>
    );
}
