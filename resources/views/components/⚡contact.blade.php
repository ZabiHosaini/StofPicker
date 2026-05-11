<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
    <section class="px-4 md:px-8 mt-6">
        <div class="max-w-xl mx-auto">
           <div class="mb-12">
              <h2 class="text-3xl font-bold text-slate-900 mb-6 md:text-4xl dark:text-slate-50">
                 Contact us
              </h2>
              <p class="text-base leading-relaxed text-slate-600 dark:text-slate-400">
                 Have a question, need support, or want to discuss your next project? We’re here to help.
              </p>
           </div>
     
           <form class="space-y-6">
              <div>
                 <label for="name"
                    class="mb-2 text-slate-900 dark:text-slate-50 font-medium text-sm inline-block">Name</label>
                 <input type="text" id="name" name="name" placeholder="John doe"
                    class="px-3 py-2.5 text-sm text-slate-900 w-full rounded-md bg-white outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />
              </div>
              <div>
                 <label for="email"
                    class="mb-2 text-slate-900 dark:text-slate-50 font-medium text-sm inline-block">Email</label>
                 <input type="email" id="email" name="email" placeholder="john@readymadeui.com"
                    class="px-3 py-2.5 text-sm text-slate-900 w-full rounded-md bg-white outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />
              </div>
              <div>
                 <label for="phone" class="mb-2 text-slate-900 dark:text-slate-50 font-medium text-sm inline-block">Phone
                    number</label>
                 <input type="number" id="phone" name="phone" placeholder="+11800-259-854"
                    class="px-3 py-2.5 text-sm text-slate-900 w-full rounded-md bg-white outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />
              </div>
              <div>
                 <label for="company"
                    class="mb-2 text-slate-900 dark:text-slate-50 font-medium text-sm inline-block">Company</label>
                 <input type="text" id="company" name="company" placeholder="XYZ pvt. ltd."
                    class="px-3 py-2.5 text-sm text-slate-900 w-full rounded-md bg-white outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />
              </div>
              <div>
                 <label for="message"
                    class="mb-2 text-slate-900 dark:text-slate-50 font-medium text-sm inline-block">Message</label>
                 <textarea placeholder="Write message" rows="6" type="text" id="message" name="message"
                    class="px-3 py-2.5 text-sm text-slate-900 w-full rounded-md bg-white outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700"></textarea>
              </div>
     
              <button type="submit"
                 class="py-2.5 px-4 text-sm rounded-md font-semibold cursor-pointer text-white border border-blue-600 bg-blue-600 hover:bg-blue-700 transition-all focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">Send
                 message</button>
           </form>
        </div>
     </section></div>