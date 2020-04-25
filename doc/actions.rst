Actions
=======

.. raw:: html

    <div class="box box--small box--warning">
        <strong class="title">WARNING:</strong>

        You are browsing the documentation for <strong>EasyAdmin 3.x</strong>,
        which hasn't been released as a stable version yet. You are probably
        using EasyAdmin 2.x in your application, so you can switch to
        <a href="https://symfony.com/doc/2.x/bundles/EasyAdminBundle/index.html">EasyAdmin 2.x docs</a>.
    </div>

**Actions** are each of the tasks that you can perform on CRUD pages. In the
``index``  page for example, you have tasks to "edit" and "delete" each entity
displayed in the listing and you have another task to "create" a new entity.

Actions are configured in the ``configureActions()`` method of your
:doc:`dashboard </dashboards>` or :doc:`CRUD controller </crud>`::

    namespace App\Controller\Admin;

    use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
    use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

    class ProductCrudController extends AbstractCrudController
    {
        // ...

        public function configureActions(Actions $actions): Actions
        {
            // ...
        }
    }

These are the actions included by default in each page:

==========  ===================================================
Page        Default Actions
==========  ===================================================
``detail``  ``delete``, ``new``, ``index``
``edit``    ``index``, ``delete``
``index``   ``delete``, ``detail``, ``new``
``new``     ``index``
==========  ===================================================

Action Names and Constants
--------------------------

Some methods require as argument the name of some action. You can use a string
with the action name (``'index'``, ``'detail'``, ``'edit'``, etc.). If you prefer
to use constants for these values, use ``Action::INDEX``, ``Action::DETAIL``,
``Action::EDIT``, etc. (they are defined in the ``EasyCorp\Bundle\EasyAdminBundle\Config\Action`` class).

Adding Actions
--------------

Use the ``add()`` method to add built-in actions (those defined as ``Action::*``
constants) and your own custom actions (explained later in this article)::

    use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
    use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER)
        ;
    }

Removing Actions
----------------

Removing actions makes them unavailable in the interface, so the user can't
click on buttons/links to run those actions. However, users can *hack* the URL
to run the action. To fully disable an action, use the ``disableActions()``
method explained later::

    use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
    use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_DETAIL, Action::EDIT)
        ;
    }

Updating an Action
------------------

This is mostly useful to change built-in actions (e.g. to change their icon,
update or remove their label, etc.). The ``update()`` method expects a callable
and EasyAdmin passes the action to it automatically::

    use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
    use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
    use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->update(Crud::PAGE_DETAIL, Action::NEW, function (Action $action) {
                $action->setIcon('fa fa-file-alt')->setLabel(false);
            })
        ;
    }

Displaying Actions Conditionally
--------------------------------

Some actions must displayed only when some conditions met. For example, a
"View Invoice" action may be displayed only when the order status is "paid".
Use the ``displayIf()`` method to configure when the action should be visible
to users::

    use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
    use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
    use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

    public function configureActions(Actions $actions): Actions
    {
            $viewInvoice = Action::new('View Invoice', 'fas fa-file-invoice')
                ->displayIf(static function ($entity) {
                    return $entity->isPublished();
                });

            return $actions
                // ...
                ->add(Crud::PAGE_INDEX, $viewInvoice);
    }

Disabling Actions
-----------------

Disabling an action means that it's not displayed in the interface and the user
can't run the action even if they *hack* the URL. If they try to do that, they
will see a "Forbidden Action" exception.

Actions are disabled globally, you cannot disable them per page::

    use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
    use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            // this will forbid to create or delete entities in the backend
            ->disableActions(Action::NEW, Action::DELETE)
        ;
    }

Restricting Actions
-------------------

Instead of disabling actions, you can restrict their execution to certain users.
Use the ``setPermission()`` to define the Symfony Security permission needed to
view and run some action.

Permissions are defined globally; you cannot define different permissions per page::

    use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
    use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->setPermission(Action::NEW, 'ROLE_ADMIN')
            ->setPermission(Action::NEW, 'ROLE_SUPER_ADMIN')
        ;
    }

Reordering Actions
------------------

Use the ``setActionOrder()`` to define the order in which actions are displayed
in some page::

    use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
    use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
    use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->setActionOrder(Crud::PAGE_INDEX, [Action::DELETE, Action::DETAIL, Action::EDIT])
        ;
    }

Dropdown Actions
----------------

If you display lots of fields on each row of the ``index`` page, there won't be
enough room for the item actions. In those cases, you can display the actions in
a dropdown menu instead of the expanded design used by default.

To do so, use the ``showEntityActionsAsDropdown()`` method::

    namespace App\Controller\Admin;

    use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
    use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

    class ProductCrudController extends AbstractCrudController
    {
        // ...

        public function configureCrud(Crud $crud): Crud
        {
            return $crud
                // ...
                ->showEntityActionsAsDropdown()
            ;
        }
    }

.. _actions-custom:

Adding Custom Actions
---------------------

In addition to the built-in actions provided by EasyAdmin, you can create your
own actions. An action always results in the execution of some method of some of
your controllers. If the method is defined in the CRUD controller, use
``linkToCrudAction()``; if the method is defined somewhere else, define a route
for it and use ``linkToRoute()``::

    namespace App\Controller\Admin;

    use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
    use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

    class ProductCrudController extends AbstractCrudController
    {
        // ...

        public function configureActions(Actions $actions): Actions
        {
            // this action executes the 'invoice()' method of the current CRUD controller
            $viewInvoice = Action::new('View invoice', 'fa fa-file-invoice')
                ->linkToCrudAction('renderInvoice');

            // if the method is not defined in a CRUD controller, link to its route
            $sendInvoice = Action::new('Send invoice', 'fa fa-envelope')
                // if the route needs parameters, you can define them:
                // 1) using an array
                ->linkToRoute('invoice_send', [
                    'send_at' => (new \DateTime('+ 10 minutes'))->format('YmdHis'),
                ])

                // 2) using a callable (useful if parameters depend on the entity instance)
                ->linkToRoute('invoice_send', function ($entity) {
                    return [
                        'uuid' => $entity->getId(),
                        'method' => $entity->sendMethod(),
                    ];
                });

            return $actions
                // ...
                ->add('viewInvoice', $viewInvoice)
                ->add('sendInvoice', $sendInvoice)
            ;
        }
    }

Batch Actions
-------------

.. note::

    Batch actions are not ready yet, but we're working on adding support for them.

.. Batch actions are a special kind of action which is applied to multiple items at
.. the same time. They are only available in the ``index`` page. The only built-in
.. batch action is ``delete``. You can remove this action as follows::
..
..     ->removeBatchAction('delete');
..
.. You can change some of its options with the following method::
..
..     $batchDelete = Action::new('Delete', 'fa-trash')->cssClass('...')->method('batchDelete');
..     // ...
..     ->setBatchAction('delete', $batchDelete);
..
.. Custom Batch Actions
.. ~~~~~~~~~~~~~~~~~~~~
..
.. Imagine that you manage users with a ``User`` entity and a common task is to
.. approve their sign ups. Instead of creating a normal ``approve`` action as
.. explained in the previous sections, create a batch action to be more productive
.. and approve multiple users at once.
..
.. First, create a method in your resource admin to handle this batch action (the
.. method will receive an array with the IDs of the selected entities)::
..
..     namespace App\Controller\Admin;
..
..     use EasyCorp\Bundle\EasyAdminBundle\Config\ResourceConfig;
..     use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractResourceAdminController;
..
..     class UserAdminController extends AbstractResourceAdminController
..     {
..         // ...
..
..         public function approveUsers(array $ids)
..         {
..             $entityClass = $this->getConfig()->getEntityClass();
..             $em = $this->getDoctrine()->getManagerForClass($entityClass);
..
..             foreach ($ids as $id) {
..                 $user = $em->find($id);
..                 $user->approve();
..             }
..
..             $this->em->flush();
..
..             // don't return anything or redirect to any URL because it will be ignored
..             // when a batch action finishes, user is redirected to the original page
..         }
..     }
..
.. Now use the ``addBatchAction()`` method to add it to your resource admin::
..
..     namespace App\Controller\Admin;
..
..     use EasyCorp\Bundle\EasyAdminBundle\Config\ResourceConfig;
..     use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractResourceAdminController;
..
..     class UserAdminController extends AbstractResourceAdminController
..     {
..         // ...
..
..         public function getIndexPageConfig(): IndexPageConfig
..         {
..             return IndexPageConfig::new()
..                 // ...
..                 ->addBatchAction('approve', Action::new('Approve', 'fa-user-check')->method('approveUsers'));
..         }
..     }