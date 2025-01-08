<main class="ml-80 flex-1 bg-white relative">
    <div class="flex flex-wrap justify-between gap-3 p-4">
        <p class="text-[#111518] tracking-light text-[32px] font-bold leading-tight min-w-72">Messages</p>
        <button
            class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#f0f2f5] text-[#111518] text-sm font-medium leading-normal"
        >
            <span class="truncate">New message</span>
        </button>
    </div>
    <section id="messages">
        <div class="flex items-center gap-4 bg-white px-4 min-h-[72px] py-2 justify-between">
            <div class="flex items-center gap-4">
                <div
                    class="bg-center bg-no-repeat aspect-square bg-cover rounded-full h-14 w-fit"
                    style='background-image: url("https://cdn.usegalileo.ai/sdxl10/a4d67f33-8886-4754-93ba-8c6c52b2dadd.png");'
                ></div>
                <div class="flex flex-col justify-center">
                    <p class="text-[#111518] text-base font-medium leading-normal line-clamp-1">Helen Chen</p>
                    <p class="text-[#60778a] text-sm font-normal leading-normal line-clamp-2">Let's chat about the product design role</p>
                </div>
            </div>
            <div class="shrink-0"><p class="text-[#60778a] text-sm font-normal leading-normal">2h</p></div>
        </div>
        <?php for ($i=0; $i<5; $i++): ?>
        <div>
            <h1><?= \Helpers\Encrypt::decrypt($messages[$i]->getContent()) ?></h1>
        </div>
        <?php endfor; ?>
    </section>
</main>